<?php 

namespace App;

//use App\Common\Header;
//use App\Common\Footer;
//use App\Common\Sidebar;
//use App\Common\Htmlheader;


class Common  {
    public $data;
  

    public function __construct($user){
        //$this->data['header']     = new Header;
        //$this->data['footer']     = new Footer;
        //$this->data['sidebar']    = new Sidebar;
        //$this->data['htmlheader'] = new Htmlheader;

        $this->data['sidebar'] = [
            'home'         => ['show' => false , 'active' => false],
            'advertising'  => ['show' => false , 'active' => false],
            'ad_acount'    => ['show' => false , 'active' => false],
            'ad_table'     => ['show' => false , 'active' => false],
        ];

        if($user->is('responsible')){
            $this->setVisable('sidebar',['home','advertising','ad_acount','ad_table']);
        }elseif($user->is('advertising')){
            $this->setVisable('sidebar',['home','ad_table']);
        }
          
    }

    public function setVisable($obj,$key){
        foreach($key as $k){
            if(isset($this->data[$obj][$k])) $this->data[$obj][$k]['show'] = true;
            continue;
        }
        return $this;
    }

    public function setInvisable($obj,$key){
        foreach($key as $k){
            if(isset($this->data[$obj][$k])) $this->data[$obj][$k]['show'] = false;
            continue;
        }
        return $this;
    }

    public function setActive($obj, $key = ''){
        if(!isset($this->data[$obj])) return $this;
        foreach($this->data[$obj] as $k=>$value){      
            $this->data[$obj][$k]['active'] = ($k == $key) ? true : false;
        }
        return $this;
    }

    public function __set($name,CommonInter $class){
        if(!isset($this->data[$name])) $this->data[$name] = $class;
    }

    public function __unset($name) {
        unset($this->data[$name]);
    }

    public function __get($name){
        return isset($this->data[$name]) ? $this->getShow($this->data[$name]) : array();
    }

    private function getShow($data){
        return array_filter( $data, function($v){ return $v['show'] ; });
    }

    public function get(){
        return $this;
    }


    

}