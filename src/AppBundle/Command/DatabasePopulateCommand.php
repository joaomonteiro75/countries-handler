<?php

namespace AppBundle\Command;

use AppBundle\Entity\Borders;
use AppBundle\Entity\Translations;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

use AppBundle\Entity\Country;

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
            $populate_result = $this->parseDataAndPopulate($output, $data_fetched);
        }
        $output->writeln('Command result:' . $populate_result);
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

	public function parseDataAndPopulate($output, $data_fetched)
	{
		$return_array = false;
        $em = $this->getContainer()->get('doctrine')->getManager();

		foreach ($data_fetched as $country)
        {
            //these are sometimes empty
			$lat = 0;
			$lng = 0;
            $tld = '';

            $newCountry = $em->getRepository('AppBundle:Country')->findOneBy(array('iso3' => $country->alpha3Code));
            if(!$newCountry)
            {
                $newCountry = new Country();
            }

            $newCountry->setName($country->name);

            if (isset($country->topLevelDomain[0]))
            {
                $tld        = $country->topLevelDomain[0];
            }
            $newCountry->setTld($tld);

            $newCountry->setIso2($country->alpha2Code);
            $newCountry->setIso3($country->alpha3Code);

            $geo            = $country->latlng;
			if (count($geo) == 2) //have both lat and lng
			{
			    $lat        = $geo[0];
                $lng        = $geo[1];
			}
            $newCountry->setLat($lat);
            $newCountry->setLng($lng);
            $newCountry->setLanguages(serialize($country->languages));

            foreach ($country->borders as $border)
            {
                $newBorder = new Borders();
                $newBorder->setBorder($border);
                $newBorder->setCountry($newCountry);
                $em->persist($newBorder);
                $newCountry->addBorder($newBorder);
            }

            foreach ($country->translations as $translation_key => $translation_value)
            {
                if ($translation_key && $translation_value)
                {
                    $newTranslation = new Translations();
                    $newTranslation->setOriginal($newCountry->getName());
                    $newTranslation->setTranslateto($translation_key);
                    $newTranslation->setTranslation($translation_value);
                    $newTranslation->setCountry($newCountry);
                    $em->persist($newTranslation);
                    $newCountry->addTranslation($newTranslation);
                }
            }

            $em->persist($newCountry);
            $em->flush();

            $echothing = $newCountry->getName() . "#" . $newCountry->getTld() . "#" . $newCountry->getIso2() . "#" . $newCountry->getIso3() . "#" . $newCountry->getLat() . "#" . $newCountry->getLng() . "\n";
            $output->writeln($echothing);
        }
		return $return_array;
	}

}
