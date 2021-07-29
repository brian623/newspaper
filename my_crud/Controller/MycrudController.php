<?php
namespace eltiempokids\my_crud\Controller;

use eltiempokids\Core\Controller\ControllerBase;
use eltiempokids\Core\Database\Database;
use eltiempokids\Core\Url;
use eltiempokids\Core\Link;
use eltiempokids\Core\Messenger;

class MycrudController extends ControllerBase
{
    public function Listing()
    {
        //Table

        $header_table = ['id'=>t('ID'),'title'=>t('Title'), 'author'=>t('Author'), 'date'=>t('Date'), 'content'=>t('Content'), 'image'=>t('Image Post'), 'tag'=>t('Tag'), 'opt'=>t('Operation'), 'opt1'=>t('Operation'),];

        $row =[];

        $conn = Database::gatConnection();

        $query = $conn->select('my_crud','m');
        $query->fields('m',['id','title','author','date','content','image','tag']);
        $result = $query-execute()-fetchAll();

        foreach ($result as $value) 
        {
            $delete = Url::fromUserInput('/my_crud/form/delete'.$value->id);
            $edit = Url::fromUserInput('/my_crud/form/data?id='.$value->id);

            $row[]= ['id'=>$value->id,'title'=>$value->title,'author'=>$value->autor,'date'=>$value->date,'content'=>$value->content,'image'=>$value->image,'tag'=>$value->tag,'opt'=>Link::fromTextAndUrl('Edit',$edit)->toString(),'opt1'=>Link::fromTextAndUrl('Delete',$delete)->toString(),];
        }

        $add = Url::fromUserInput('/my_crud/form/data');

        $text = "Add User";

        $data['table']= ['#type' => 'table', '#header'=>$header_table,'#rows'=>$row, '#empty'=>t('No Record Found'),'#caption'=>Link::fromTextAndUrl($text,$add)->toString(),];

        $this->messenger()->addMessage('Records Listed');

        return $data;
    }
}


?>