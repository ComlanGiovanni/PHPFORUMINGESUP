<?php
namespace Giovanni\plugin;
class Comments{

    private $db;
    private $options = array('content_error' => "Vous n'avez pas entrer de commentaire");

    public $errors = array();

    public function __construct($db, $options = []){
        $this->db = $db;
        $this->options = array_merge($this->options, $options);
    }

    public function findAll($ref,$ref_id){
        $com = $this->db->prepare("
              SELECT *
              FROM comments
              WHERE ref_id = :ref_id
              AND ref= :ref
              ORDER BY created ASC");/*DESC*/
        $com->execute(['ref' => $ref, 'ref_id' => $ref_id]);

        return $com->fetchAll();
    }

    public function save($ref, $ref_id){
        $errors = [];

        if(empty($_POST['content'])){
            $errors['content'] = $this->options['content_error'];
        }

        if(count($errors) > 0){
            $this->errors = $errors;
            return false;
        }

        $q = $this->db->prepare("INSERT INTO comments SET
                            username = :username,
                            content = :content,
                            ref_id = :ref_id,
                            ref = :ref,
                            created = :created");
        $data = ['username' => $_SESSION['auth']->username,
                'content'=> $_POST['content'],
                'ref_id' => $ref_id,
                'ref' => $ref,
                'created'=>date('Y-m-d H:i:s')];
        return $q->execute($data);

    }


}