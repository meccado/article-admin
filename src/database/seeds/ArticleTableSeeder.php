<?php

use Illuminate\Database\Seeder;

use App\Menu as Menu;
use App\User as User;

class  ArticleTableSeeder extends Seeder
{
    public function run()
    {

      $super_admin_user = User::where('email','=','super@domain.com')->first();
      $admin_user = User::where('email','=','admin@domain.com')->first();

       $article_dashboard = Menu::create( [
          'name'               => 'Article',
          'title'              => 'Article',
          'parent_id'          => '0',
          'icon'               => 'fa fa-newspaper-o fa-fw',
          'sort_order'         => '0',
          'url'                => 'admin/carouarticles',
      ] );
      $article_dashboard->assign($super_admin_user);
      $article_dashboard->assign($admin_user);
    }
}
