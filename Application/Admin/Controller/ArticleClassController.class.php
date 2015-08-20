<?php
namespace Admin\Controller;
use Admin\Controller\UserBaseController;

class ArticleClassController extends UserBaseController{
    public function index(){
        $ac_model = D('ArticleClass');
        $count = $ac_model->field('COUNT(ac_id) as count')->find();
        $pagination['count'] = $count['count'];
        $pagination['page'] = is_numeric(I('post.pageNum')) ? I('post.pageNum')-1 : 0;
        $pagination['perpage'] = is_numeric(I('post.numPerPage')) ? I('post.numPerPage') : 5;
        $pagination['pagenum'] = ceil($pagination['count'] / $pagination['perpage']);
        $pagination['offset'] = $pagination['page'] * $pagination['perpage'];
        $ac_list = $ac_model->order('ac_id ASC')->page($pagination['page']+1, $pagination['perpage'])->select();
        $this->assign(array('ac_list'=> $ac_list, 'pagination'=>$pagination));
        $this->display();
    }
    
    public function add(){
        $ac_model = D('ArticleClass');
        if(IS_POST){
            if($ac_model->create()){
                if($ac_model->add()){
                    $result = $this->message("添加成功");
                }else{
                    $result = $this->message("添加失败", 300);
                }
            }else{
                $result = $this->message($ac_model->getError(), 300);
            }
            echo $result;
        }else{
            $ac_list = $ac_model->select();
            $this->assign('ac_list', $ac_list);
            $this->display();
        }
    }
}