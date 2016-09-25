<?php

namespace AppBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class DatabasePopulateCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('database:populate')
            ->setDescription('Fetches Data from Api and Populates Database')
            ->addArgument('db', InputArgument::OPTIONAL, 'Destination database')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $argument = $input->getArgument('db');

	$data_fetched = $this->fetchData($output);
	if ($data_fetched)
	{
		$data_parsed = $this->parseData($output, $data_fetched);
	}
	if ($data_parsed)
	{
		$this->populateDB($output, $data_parsed);
	}
        $output->writeln('Command result.');
    }

	public function fetchData($output)
	{
		$url = 'https://restcountries.eu/rest/v1/all';
		
		try
		{
			$json = file_get_contents($url);
			$countries = json_decode($json);
		}
		catch (Exception $e)
		{
		}
		
		if ($countries && count($countries) > 0)
		{
			$output->writeln('fetched ' . count($countries) . ' countries.');
			return $countries;
		}
		else
		{
			$output->writeln('No countries found.');
			return false;
		}

	}

	public function parseData($output, $data_fetched)
	{
		$return_array = false;
		foreach ($data_fetched as $country)
                {
                        $name = $country->name;

$output->writeln(">>>>>>>>>>>>>" . $name . "\n");

			$lat = 0;
			$lng = 0;
                        $tld = $country->topLevelDomain[0];
                        $iso2 = $country->alpha2Code;
                        $iso3 = $country->alpha3Code;
                        $geo = $country->latlng;
			if (count($geo) == 2)
			{
                        	$lat = $geo[0];
                        	$lng = $geo[1];
			}
                        $translations = $country->translations;
                        $borders = $country->borders;
                        $languages = $country->languages;

                        $echothing = $name . "#" . $tld . "#" . $iso2 . "#" . $iso3 . "#" . $lat . "#" . $lng . "\n";
                        $return_array[] = $echothing; 
                        $output->writeln($echothing);
                }
		return $return_array;
	}

	public function populateDB($output, $data_parsed)
	{
		$output->writeln('saving objects');
	}

}
