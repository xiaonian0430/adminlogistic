<?php
namespace Data\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
       sleep(10);
       header("Content-type:application/Json");
       echo '[{
                title: "Meet Joe Black",
                languages: [
                  {name: "English1"},
                  {name: "French"}
                ],
                tmpl: "#columnTemplate"
              },
              {
                title: "Eyes Wide Shut",
                languages: [
                  {name: "French"},
                  {name: "Esperanto"},
                  {name: "Spanish"}
                ],
                tmpl: "#rowTemplate"
              },
              {
                title: "The Inheritance",
                languages: [
                  {name: "English"},
                  {name: "German"}
                ],
                tmpl: "#columnTemplate"
              }]';
    }
}