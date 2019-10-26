<?php
use PubNub\PubNub;
use PubNub\Enums\PNStatusCategory;
use PubNub\Callbacks\SubscribeCallback;
use PubNub\PNConfiguration;

namespace frontend\models;

use Yii;
use yii\base\Model;


class Pubnub extends SubscribeCallback {



    function status($pubnub, $status) {
        if ($status->getCategory() === PNStatusCategory::PNUnexpectedDisconnectCategory) {
            // This event happens when radio / connectivity is lost
        } else if ($status->getCategory() === PNStatusCategory::PNConnectedCategory) {
            // Connect event. You can do stuff like publish, and know you'll get it
            // Or just use the connected event to confirm you are subscribed for
            // UI / internal notifications, etc
        } else if ($status->getCategory() === PNStatusCategory::PNDecryptionErrorCategory) {
            // Handle message decryption error. Probably client configured to
            // encrypt messages and on live data feed it received plain text.
        }
    }

    function message($pubnub, $message) {
        
    }

    function presence($pubnub, $presence) {
        // handle incoming presence data
    }
}

	$pnconf = new PNConfiguration();
	$pubnub = new PubNub($pnconf);

	$pnconf->setSubscribeKey("sub-c-9a5383e4-f424-11e9-bdee-36080f78eb20");
	$pnconf->setPublishKey("pub-c-e371713b-ce3a-41c9-89e1-ac0d397c8e9a");
	$subscribeCallback = new MySubscribeCallback()
	$pubnub->addListener($subscribeCallback);

	// Subscribe to a channel, this is not async.
	$pubnub->subscribe()
	    ->channels("rutusha")
	    ->execute();

	$result = $pubnub->publish()
              ->channel("rutusha")
              ->message("Hello PubNub")
              ->sync();

		print_r($result);
// Use the publish command separately from the Subscribe code shown above.
// Subscribe is not async and will block the execution until complete.

