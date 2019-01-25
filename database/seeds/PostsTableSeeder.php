<?php

use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        

            $xml = simplexml_load_file('public/assets/sport-rt.xml');
            
            foreach($xml->channel->item as $item)
            {
                    
                    $content = $item->children('http://purl.org/rss/1.0/modules/content/');
                    $content2 = $item->children('http://wordpress.org/export/1.2/');
                    
                    //dump($pom);
                    $title = $item->title;
                    $url = $item->link;
                    $urlx = explode('/', $url, 5);
                    $content = htmlentities($content->encoded);
                    $pubDate = trim($item->pubDate);
                             
                    
                DB::table('posts')->insert([
                        //
                        'url' => '/'.$urlx[3],
                        'user_id' => 1,
                        'photo_id' => 1, 
                        'category_id' => 1, 
                        'author' => 'RT',
                        'source' => 'RT',
                        'title' => $title,
                        'slug' => $urlx[3],
                        'content' => $content,
                        'published' => 1,
                        'featured' => rand(0, 1),
                        'count' => 1, 
                        'created_at' => gmdate('Y-m-d H:i:s', strtotime($pubDate)),
                        'updated_at' => gmdate('Y-m-d H:i:s', strtotime($pubDate))
                ]);
                     
            }
    }
}
