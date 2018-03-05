<?php
class FakeData
{
    public function moreScript()
    {
        $typeIdList = [
            '剧情' => '5a9bb12f50cc87d908cde1a8',
            '爱情' => '5a9bb12f50cc87d908cde1a9',
            '喜剧' => '5a9bb12f50cc87d908cde1ad',
            '科幻' => '5a9bb12f50cc87d908cde1ae',
            '动作' => '5a9bb12f50cc87d908cde1af',
            '悬疑' => '5a9bb12f50cc87d908cde1b0',
            '犯罪' => '5a9bb12f50cc87d908cde1b1',
            '战争' => '5a9bb12f50cc87d908cde1b2',
            '文艺' => '5a9bb12f50cc87d908cde1b3',
        ];
        $doc = [
            'name' => '低俗小说',
            'fileUrl' => 'http://scriptfile.ekaogo.com/低俗小说.txt',
            'coverUrl' => 'http://scriptfile.ekaogo.com/WechatIMG1222.jpeg',
            'typeIds' => ['5a9bb12f50cc87d908cde1a8', '5a9bb12f50cc87d908cde1ae'],
            'scriptType' => ['剧情', '喜剧'],
            'readerNum' => 120,
            'writer' => ['昆汀·塔伦蒂诺', '罗杰·阿夫瑞'],
            'createTime' => time(),
        ];
        $n = 0;
        $obj = new ModelDaoScript();
        while ($n < 20) {
            $typeIdArr = array_rand($typeIdList, 2);
            $doc['scriptType'] = $typeIdArr;
            $typeIds = [];
            foreach ($typeIdArr as $key) {
                $typeIds[] = $typeIdList[$key];
            }
            $doc['typeIds'] = $typeIds;
            $doc['_id'] = new MongoId();
            $obj->add($doc);
            $n++;
        }
    }

    public function execute()
    {
        $typeId1 = (string)new MongoId();
        $typeId2 = (string)new MongoId();
        $scriptId = (string)new MongoId();
        $userId = (string)new MongoId();
        $pkgId = (string)new MongoId();

        $this->script($scriptId, $typeId1, $typeId2);
        $this->scriptType($typeId1, $typeId2);
        $this->noteMark($scriptId, $userId, $pkgId);
        $this->user($userId);
        $this->partPkg($userId, $pkgId);
        $this->operation();
        $this->readStatus($userId, $scriptId);
        $this->readRecord($userId, $scriptId);
        $this->bookCase($userId, $scriptId);
    }

    public function script($scriptId, $typeId1, $typeId2)
    {
        $doc = [
            '_id' => new MongoId($scriptId),
            'name' => '低俗小说',
            'fileUrl' => 'http://scriptfile.ekaogo.com/低俗小说.txt',
            'coverUrl' => 'http://scriptfile.ekaogo.com/WechatIMG1222.jpeg',
            'typeIds' => [$typeId1, $typeId2],
            'scriptType' => ['剧情', '喜剧'],
            'readerNum' => 120,
            'writer' => ['昆汀·塔伦蒂诺', '罗杰·阿夫瑞'],
            'createTime' => time(),
        ];

        $obj = new ModelDaoScript();
        $obj->add($doc);
    }

    public function scriptType($typeId1, $typeId2)
    {
        $doc = [
            [
                '_id' => new MongoId($typeId1),
                'name' => '剧情',
                'eName' => 'drama',
                'scriptNum' => '99',
                'coverUrl' => ['http://scriptfile.ekaogo.com/WechatIMG1222.jpeg', 'http://scriptfile.ekaogo.com/WechatIMG1222.jpeg', 'http://scriptfile.ekaogo.com/WechatIMG1222.jpeg'],
            ],
            [
                '_id' => new MongoId($typeId2),
                'name' => '爱情',
                'eName' => 'romance',
                'scriptNum' => '99',
                'coverUrl' => ['http://scriptfile.ekaogo.com/WechatIMG1222.jpeg', 'http://scriptfile.ekaogo.com/WechatIMG1222.jpeg', 'http://scriptfile.ekaogo.com/WechatIMG1222.jpeg'],
            ],
            [
                'name' => '喜剧',
                'eName' => 'comedy',
                'scriptNum' => '99',
                'coverUrl' => ['http://scriptfile.ekaogo.com/WechatIMG1222.jpeg', 'http://scriptfile.ekaogo.com/WechatIMG1222.jpeg', 'http://scriptfile.ekaogo.com/WechatIMG1222.jpeg'],
            ],
            [
                'name' => '科幻',
                'eName' => 'science fiction',
                'scriptNum' => '99',
                'coverUrl' => ['http://scriptfile.ekaogo.com/WechatIMG1222.jpeg', 'http://scriptfile.ekaogo.com/WechatIMG1222.jpeg', 'http://scriptfile.ekaogo.com/WechatIMG1222.jpeg'],
            ],
            [
                'name' => '动作',
                'eName' => 'action',
                'scriptNum' => '99',
                'coverUrl' => ['http://scriptfile.ekaogo.com/WechatIMG1222.jpeg', 'http://scriptfile.ekaogo.com/WechatIMG1222.jpeg', 'http://scriptfile.ekaogo.com/WechatIMG1222.jpeg'],
            ],
            [
                'name' => '悬疑',
                'eName' => 'suspense',
                'scriptNum' => '99',
                'coverUrl' => ['http://scriptfile.ekaogo.com/WechatIMG1222.jpeg', 'http://scriptfile.ekaogo.com/WechatIMG1222.jpeg', 'http://scriptfile.ekaogo.com/WechatIMG1222.jpeg'],
            ],
            [
                'name' => '犯罪',
                'eName' => 'crime',
                'scriptNum' => '99',
                'coverUrl' => ['http://scriptfile.ekaogo.com/WechatIMG1222.jpeg', 'http://scriptfile.ekaogo.com/WechatIMG1222.jpeg', 'http://scriptfile.ekaogo.com/WechatIMG1222.jpeg'],
            ],
            [
                'name' => '战争',
                'eName' => 'war',
                'scriptNum' => '99',
                'coverUrl' => ['http://scriptfile.ekaogo.com/WechatIMG1222.jpeg', 'http://scriptfile.ekaogo.com/WechatIMG1222.jpeg', 'http://scriptfile.ekaogo.com/WechatIMG1222.jpeg'],
            ],
            [
                'name' => '文艺',
                'eName' => 'art',
                'scriptNum' => '99',
                'coverUrl' => ['http://scriptfile.ekaogo.com/WechatIMG1222.jpeg', 'http://scriptfile.ekaogo.com/WechatIMG1222.jpeg', 'http://scriptfile.ekaogo.com/WechatIMG1222.jpeg'],
            ],
        ];

        $obj = new ModelDaoScriptType();
        foreach ($doc as $data) {
            $obj->add($data);
        }
    }

    public function noteMark($scriptId, $userId, $pkgId)
    {
        $doc = [
            'type' => 1,
            'scriptId' => new MongoId($scriptId),
            'userId' => new MongoId($userId),
            'markPos' => [10, 30],
            'mark' => '景 咖啡店 早上

洛杉矶一家普通的邓氏',
            'note' => '我是笔记我是笔记我是笔记,我是笔记我是笔记我是笔记我是笔记我是笔记我是笔记',
            'pkgId' => new MongoId($pkgId),
            'createTime' => time(),
            'updateTime' => time(),
            'status' => 1,
        ];

        $obj = new ModelDaoNoteMark();
        $obj->add($doc);
    }

    public function user($userId)
    {
        $doc = [
            '_id' => new MongoId($userId),
            'nickName' => '乔布斯',
            'avatarUrl' => 'http://scriptfile.ekaogo.com/乔布斯.png',
            'gender' => 1,
            'city' => '上海',
            'province' => '上海',
            'country' => '中国',
            'language' => 'zh_cn',
            'phoneNum' => '15951960273',
            'readNum' => 13,
            'readDays' => 10,
            'keepReadDays' => 3,
            'lastReadTime' => time() - 86400,
            'readNumRatio' => 0.2,
            'readDayRatio' => 0.7,
            'fontSize' => CommonConst::DEFAULT_FONT_SIZE,
            'backColor' => CommonConst::DEFAULT_BACK_COLOR,
            'createTime' => time() - 86400*30,
            'updateTime' => time() - 86400,
        ];
        $obj = new ModelDaoUser();
        $obj->add($doc);
    }

    public function partPkg($userId, $pkgId)
    {
        $doc = [
            '_id' => new MongoId($pkgId),
            'userId' => new MongoId($userId),
            'name' => '收藏',
            'partNum' => 1,
            'createTime' => time(),
            'updateTime' =>time(),
            'status' => 1,
        ];
        $obj = new ModelDaoPartPkg();
        $obj->add($doc);
    }

    public function operation()
    {
        $doc = [
            [
                'type' => 1,
                'resourceUrl' => 'http://scriptfile.ekaogo.com/1.png',
                'sort' => 1,
                'status' => 1,
            ],
            [
                'type' => 1,
                'resourceUrl' => 'http://scriptfile.ekaogo.com/2.png',
                'sort' => 2,
                'status' => 1,
            ],
        ];

        $obj = new ModelDaoOperation();
        foreach ($doc as $data) {
            $obj->add($data);
        }
    }

    public function readStatus($userId, $scriptId)
    {
        $doc = [
            'userId' => new MongoId($userId),
            'scriptId' => new MongoId($scriptId),
            'readPos' => '123',
            'updateTime' => time(),
        ];
        $obj = new ModelDaoReadStatus();
        $obj->add($doc);
    }

    public function readRecord($userId, $scriptId)
    {
        $doc = [
            'userId' => new MongoId($userId),
            'scriptId' => new MongoId($scriptId),
            'num' => 12,
            'updateTime' => time(),
        ];
        $obj = new ModelDaoReadRecord();
        $obj->add($doc);
    }

    public function bookCase($userId, $scriptId)
    {
        $doc = [
            '_id' => new MongoId($userId),
            'scriptIds' => [$scriptId],
        ];
        $obj = new ModelDaoBookCase();
        $obj->add($doc);
    }
}
