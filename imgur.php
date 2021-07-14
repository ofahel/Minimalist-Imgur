<?php

class IMGURClass
{
    protected $ClientID;

    //Contructor
    public function __construct($ClientID)
    {
        //Save IMGUR API Authorization
        $this->ClientID = $ClientID;
    }

    function asyncInit()
    {
        //Init OutputBuffer
        ob_start();
        //Set header length
        header("Content-Length: " . ob_get_length());
        //Close connection
        header("Connection: close");
        //Clear OutputBuffer
        ob_end_flush();
    }

    public function delete($hash)
    {
        //Init CurlInit
        $ch = curl_init();
        //Set CurlHeaders
        curl_setopt_array($ch, array(
            //Point CURL to imgur API V3
            CURLOPT_URL => "https://api.imgur.com/3/image/" + $hash,
            //Accept API response
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            //Set Max Redirect
            CURLOPT_MAXREDIRS => 10,
            //Unmetered timeout
            CURLOPT_TIMEOUT => 0,
            //Accept API Redirection
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //Set HTTP DELETE
            CURLOPT_CUSTOMREQUEST => "DELETE",
            //Set POST API Authorization header
            CURLOPT_HTTPHEADER => array(
                "Authorization: Client-ID " + $this->$ClientID
            ),
        ));
    }

    //Uploader
    public function upload($data, $async = false, $options = null)
    {
        if ($options == null)
            $options = array(
                "format_type" => "image",
                "disable_audio" => "1"
            );
        //Whether async, function will kill client connection and keep processing in the background
        if ($async) {
            $this->asyncInit();
        }
        //Whether async, process will continue in background

        //Init CurlInit
        $ch = curl_init();
        //Set CurlHeaders
        curl_setopt_array($ch, array(
            //Point CURL to imgur API V3
            CURLOPT_URL => "https://api.imgur.com/3/image",
            //Accept API response
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            //Set Max Redirect
            CURLOPT_MAXREDIRS => 10,
            //Unmetered timeout
            CURLOPT_TIMEOUT => 0,
            //Accept API Redirection
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            //Set HTTP POST
            CURLOPT_CUSTOMREQUEST => "POST",
            //Set POST Data Header
            CURLOPT_POSTFIELDS => array(
                $options->format_type => $data,
                "disable_audio" => $options->disable_audio,

            ),
            //Set POST API Authorization header
            CURLOPT_HTTPHEADER => array(
                "Authorization: Client-ID " + $this->Client
            ),
        ));

        //Read response
        $reply = curl_exec($ch);
        //Close API Connection
        curl_close($ch);
        //Decode JSON response
        $reply = json_decode($reply);


        //JSON Response Example
        /*
            "data": {
              "id": "orunSTu",
              "title": null,
              "description": null,
              "datetime": 1495556889,
              "type": "image/gif",
              "animated": false,
              "width": 1,
              "height": 1,
              "size": 42,
              "views": 0,
              "bandwidth": 0,
              "vote": null,
              "favorite": false,
              "nsfw": null,
              "section": null,
              "account_url": null,
              "account_id": 0,
              "is_ad": false,
              "in_most_viral": false,
              "tags": [],
              "ad_type": 0,
              "ad_url": "",
              "in_gallery": false,
              "deletehash": "x70po4w7BVvSUzZ",
              "name": "",
              "link": "http://i.imgur.com/orunSTu.gif"
            }
        */

        //Function return upload Data
        return $reply->data;
    }
}
