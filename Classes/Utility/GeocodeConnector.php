<?php
/**
 * This file is part of the ObisConcept.NeosGmaps package.
 *
 * For the full copyright and license information, please
 * view the LICENSE file which was distributed with this
 * source code.
 *
 * @author Maximilian Schmidt <m.schmidt@obis-concept.de>
 * @copyright 2018 obis|CONCEPT GmbH & Co. KG
 * @license https://www.gnu.org/licenses/gpl-3.0.html GPL-3.0
 */

namespace ObisConcept\NeosGmaps\Utility;

use Curl\Curl;
use ObisConcept\NeosGmaps\Exceptions\GeocodeRequestException;

class GeocodeConnector
{
    protected const GEOCODE_API_ENDPOINT = 'https://maps.googleapis.com/maps/api/geocode/json?key={KEY}&address={VALUE}';

    /**
     * @Flow\InjectConfiguration("apiKey")
     * @var string
     */
    protected $apiKey;

    /**
     * Encodes the given target address to geocoordinates.
     *
     * @param string $targetAddress The address to encode
     * @return array The encoded geocoordinates
     * @throws GeocodeRequestException
     */
    public function encode(string $targetAddress) : array
    {
        $request = new Curl();

        $targetUrl = $this->getEndpointUrl($targetAddress);
        $request->get($targetUrl);

        $data = $request->getResponse();

        \Kint::dump($data);

        die;
    }

    public function decode(string $lat, string $lng) : string
    {
    }

    protected function getEndpointUrl(string $targetAddress) : string
    {
        $endpoint = self::GEOCODE_API_ENDPOINT;

        // Replace API key placeholder in endpoint URL
        $endpoint = str_replace('{KEY}', $this->apiKey, self::GEOCODE_API_ENDPOINT);
        // Replace adress placeholder in endpoint URL
        $endpoint = str_replace('{VALUE}', $targetAddress, $endpoint);

        return $endpoint;
    }
}