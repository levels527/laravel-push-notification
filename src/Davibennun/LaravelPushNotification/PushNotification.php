<?php namespace Davibennun\LaravelPushNotification;

class PushNotification {
	public function app($appName){
		return new App(\Config::get('laravel-push-notification::'.$appName));
	}
	public function Message(){
        $message = new \ReflectionClass('Sly\NotificationPusher\Model\Message');
        return $message->newInstanceArgs(func_get_args());
	}
	public function Device(){
        $device = new \ReflectionClass('Sly\NotificationPusher\Model\Device');
        return $device->newInstanceArgs(func_get_args());
	}
	public function DeviceCollection(){
        $deviceCollection = new \ReflectionClass('Sly\NotificationPusher\Collection\DeviceCollection');
        return $deviceCollection->newInstanceArgs(func_get_args());
	}
	public function PushManager(){
        $pushManager = new \ReflectionClass('Sly\NotificationPusher\PushManager');
        return $pushManager->newInstanceArgs(func_get_args());
	}
	public function ApnsAdapter(){
        $apnsAdapter = new \ReflectionClass('Sly\NotificationPusher\Adapter\ApnsAdapter');
        return $apnsAdapter->newInstanceArgs(func_get_args());
	}
	public function GcmAdapter(){
        $gcmAdapter = new \ReflectionClass('Sly\NotificationPusher\Model\GcmAdapter');
        return $gcmAdapter->newInstanceArgs(func_get_args());
	}
	public function Push(){
        $push = new \ReflectionClass('Sly\NotificationPusher\Model\Push');
        return $push->newInstanceArgs(func_get_args());
	}
}