<?php

namespace App\Console\Commands;

use GuzzleHttp\Client;
use Illuminate\Console\Command;

class ESInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
//    启动脚本的命令
    protected $signature = 'es:init';

    /**
     * The console command description.
     *
     * @var string
     */
//    命令的描述
    protected $description = 'init laravel es for post';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
//    handle 是实际要做的事情
    public function handle()
    {
//        创建template
        $client = new Client();
        $url = config('scout.elasticsearch.hosts')[0] . '/_template/jianshu';
//        要先确认这个模板不存在
        $client->delete($url);
//        创建模板
        $params = [
            'json' => [
                // 对这个索引起作用
                'template' => config('scout.elasticsearch.index'),
                // 'settings' => [
                //     'number_of_shards' => 1
                // ],
                'mappings' => [
                    '_default_' => [
                        // '_all' => [
                        //     'enabled' => true
                        // ],
                        'dynamic_templates' => [
                            [
                                'strings' => [
                                    // 猜测是string 类型，把string类型的都分析成文本
                                    'match_mapping_type' => 'string',
                                    'mapping' => [
                                        'type' => 'text',
                                        // 用户ik 进行文本分析
                                        'analyzer' => 'ik_smart',
                                        // 'ignore_above' => 256,
                                        'fields' => [
                                            'keyword' => [
                                                'type' => 'keyword'
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
            ],
        ];
        $client->put($url,$params);
//       控制台做记录
        $this->info('=======创建模板成功====');
//        创建index
        $url = config('scout.elasticsearch.hosts')[0] . '/' . config('scout.elasticsearch.index');
        $client->delete($url);
        $params=[
            'json' => [
                'settings' => [
                    'refresh_interval' => '5s',
                    'number_of_shards' => 1,
                    'number_of_replicas' => 0,
                ],
                'mappings' => [
                    '_default_' => [
                        '_all' => [
                            'enabled' => false
                        ]
                    ]
                ]
            ]
        ];
        $client->put($url,$params);
        //        控制台做记录
        $this->info('=======创建索引成功====');
    }
}
