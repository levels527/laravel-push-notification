<?php namespace Davibennun\LaravelPushNotification;

use Sly\NotificationPusher\PushManager,
    Sly\NotificationPusher\Model\Device,
    Sly\NotificationPusher\Model\Message,
    Sly\NotificationPusher\Model\Push;

class App{
	public function __construct($config){
		$this->pushManager = new PushManager($config['environment'] == "development" ? PushManager::ENVIRONMENT_DEV : PushManager::ENVIRONMENT_PROD);
		
		$service = $config['service'];
		$adapterClassName = 'Sly\\NotificationPusher\\Adapter\\'.ucfirst($service);

		$adapterConfig = $config;
		unset($adapterConfig['environment'], $adapterConfig['service']);
		
		$this->adapter = new $adapterClassName($adapterConfig);

		if ($service === 'gcm') {
			$this->adapter->setAdapterParameters(array('sslverifypeer' => false));
		}
	}

    public function to($addressee)
    {
        $this->addressee = is_string($addressee) ? new Device($addressee) : $addressee;

        return $this;
    }

    public function send($message, $options = array())
    {
        $push = new Push($this->adapter, $this->addressee, ($message instanceof Message) ? $message : new Message($message, $options));

        $this->pushManager->add($push);

        return $this->pushManager->push();
    }

}