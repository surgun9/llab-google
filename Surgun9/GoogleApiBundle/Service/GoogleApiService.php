<?php
namespace Surgun9\GoogleApiBundle\Service;

/**
 * Class GoogleApiService
 * @package Surgun9\GoogleApiBundle\Service
 */
class GoogleApiService
{

    protected $clientId;
    protected $serviceEmail;
    protected $keyFile;
    protected $scope;
    protected $profileId;

    /**
     * @return mixed
     */
    public function __construct()
    {
        return $this;
    }

    /**
     * @param $clientId
     * @return $this
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param $serviceEmail
     * @return $this
     */
    public function setServiceEmail($serviceEmail)
    {
        $this->serviceEmail = $serviceEmail;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getServiceEmail()
    {
        return $this->serviceEmail;
    }

    /**
     * @param $keyFile
     * @return $this
     */
    public function setKeyFile($keyFile)
    {
        $this->keyFile = $keyFile;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getKeyFile()
    {
        return $this->keyFile;
    }

    /**
     * @param $scope
     * @return $this
     */
    public function setScope($scope)
    {
        $this->scope = $scope;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * @param $profileId
     * @return $this
     */
    public function setProfileId($profileId)
    {
        $this->profileId = $profileId;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getProfileId()
    {
        return $this->profileId;
    }

    /**
     * @return \Google_Client
     */
    public function getGoogleClient()
    {


        if (file_exists($this->keyFile)) {

            $key = file_get_contents($this->keyFile);

            $auth = new \Google_Auth_AssertionCredentials(
                $this->serviceEmail,
                $this->scope,
                $key
            );


            $client = new \Google_Client();
            $client->setScopes($this->scope);
            $client->setAssertionCredentials($auth);

            if ($client->getAuth()->isAccessTokenExpired()) {
                $client->getAuth()->refreshTokenWithAssertion($auth);
            }


            $client->setClientId($this->clientId);


        } else {
            $client = false;
        }



        return $client;

    }
}
