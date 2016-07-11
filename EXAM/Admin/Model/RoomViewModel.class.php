<?php
namespace Admin\Model;
use Think\Model\ViewModel;
class RoomViewModel extends ViewModel {
    public $viewFields = array(
        'Room'=>array('id','roomName','paper','startTime','endTime','userRange','timeLimit',
            'forceEnd','memo','ownerId','createTime','status','paperAuto',
            'questionHowMany','questionType1','questionType2','questionType3','questionType4',
        ),
        'Users'=>array('id'=>'userid','username','_on'=>'Users.id=Room.ownerId'),
        'Paper'=>array('id'=>'paperid','paperName','_on'=>'Room.paper=paper.id'),
    );
}