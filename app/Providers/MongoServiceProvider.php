<?php

namespace App\Providers;

use App\Helpers\Passport\AuthCode;
use App\Helpers\Passport\Client;
use App\Helpers\Passport\PersonalAccessClient;
use App\Helpers\Passport\Token;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class MongoServiceProvider extends ServiceProvider{
  public function boot(){
    // 
  }

  public function register(){
    $loader = AliasLoader::getInstance();
    $loader->alias('Laravel\Passport\AuthCode', AuthCode::class);
    $loader->alias('Laravel\Passport\Client', Client::class);
    $loader->alias('Laravel\Passport\PersonalAccessClient', PersonalAccessClient::class);
    $loader->alias('Laravel\Passport\Token', Token::class);
  }

  public function provides(){
    // 
  }
}