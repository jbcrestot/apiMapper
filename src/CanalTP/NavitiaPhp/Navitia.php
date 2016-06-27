<?php

namespace CanalTP\NavitiaPhp;

use CanalTP\NavitiaPhp\Api\Coords;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\OptionsResolver\OptionsResolver;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;
use CanalTP\NavitiaPhp\Exception\NavitiaException;
use CanalTP\NavitiaPhp\Api\Coverage;
use CanalTP\NavitiaPhp\Api\TrafficReports;

class Navitia
{
    private $httpClient;
    /**
     * @var string
     */
    private $defaultCoverage;
    private $debug;

    private $coverage = null;
    private $trafficReports = null;
    private $coords = null;

    /**
     * Navitia constructor.
     */
    public function __construct(Client $httpClient, $coverage, $debug = false)
    {
        $this->httpClient = $httpClient;
        $this->defaultCoverage = $coverage;
        $this->debug = $debug;
    }

    /**
     * allow you to get different api and construct your path
     *
     * @param $apiName
     * @return Coverage|TrafficReports|null
     * @throws NavitiaException
     */
    public function get($apiName)
    {
        switch ($apiName) {
            case 'coverage':
                if (is_null($this->coverage)) {
                    $this->coverage = new Coverage($this);
                }

                return $this->coverage;
            case 'trafficReports':
                if (is_null($this->trafficReports)) {
                    $this->trafficReports = new TrafficReports($this);
                }

                return $this->trafficReports;
            case 'coords':
                if (is_null($this->coords)) {
                    $this->coords = new Coords($this);
                }

                return $this->coords;
            default:
                throw new NavitiaException('Can\'t find API : ' . $apiName, 500);
        }
    }

    public function call($options)
    {
        try
        {
            $this->configureOptions($options);

            $result = $this->httpClient->get($this->buildUrl($options));
            if (200 !== $result->getStatusCode()) {

                throw new NavitiaException('bad response from navitia api', 500);
            }
            
            return Yaml::parse((string) $result->getBody());
        }
        catch (ClientException $e) {
            dump('verify your request : 404');
            dump($e);
        }
        catch (ServerException $e) {
            dump('Navitia is down : 500');
            dump($e);
        }
        catch (RequestException $e) {
            dump('Something wrong happen');
            dump($e);
        }
    }

    public function configureOptions(&$options)
    {
        dump($options);
        $resolver = new OptionsResolver();
        $resolver->setDefaults(array(
            'coverage' => $this->defaultCoverage,
            'path'     => null,
            'parameters' => null
        ));

        $options = $resolver->resolve($options);
    }

    private function buildUrl($options)
    {
        $url = 'coverage/'. (empty($options['coverage']) ? '' : $options['coverage'] .'/');

        if (!empty($options['path'])) {
            foreach ($options['path'] as $item) {
                $url .= $item['element'] .'/'. $item['value']. '/';
            }
        }

        if (!empty($options['parameters'])) {
            $url .= '?';
            foreach ($options['parameters'] as $key => $item) {
                if (0 !== $key) {
                    $url .= '&';
                }

                $url .= $item['element'] .'='. $item['value'];
            }
        }

        if ($this->debug) {
            // TODO replace by log
            dump($url);
        }

        return $url;
    }


    /**
     * @return string
     */
    public function getDefaultCoverage()
    {
        return $this->defaultCoverage;
    }
}