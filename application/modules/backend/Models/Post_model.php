<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post_model extends MY_Model{

  var $column_order = array(null,'post.created','post.title');
  var $order = array('post.id_post'=>"DESC");
  var $select = "post.id_post,
                  post.title,
                  post.slug,
                  post.gambar,
                  post.deskripsi,
                  post.id_kategori,
                  post.meta_seo,
                  post.created,
                  post.modified,
                  post.is_delete,
                  kategori.kategori,
                  kategori.kategori_slug";

  private function _get_datatables_query()
    {
      $this->db->select($this->select);
      $this->db->from("post");
      $this->db->join("kategori","kategori.id_kategori = post.id_kategori","left");
      $this->db->where("post.is_delete","0");
      if($this->input->post('title'))
        {
            $this->db->like('post.title', $this->input->post('title'));
        }
      if($this->input->post('kategori'))
        {
            $this->db->like('kategori.kategori', $this->input->post('kategori'));
        }


      if(isset($_POST['order'])) // here order processing
       {
           $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
       }
       else if(isset($this->order))
       {
           $order = $this->order;
           $this->db->order_by(key($order), $order[key($order)]);
       }

    }


    public function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    public function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_all()
    {
        $this->db->select($this->select);
        $this->db->from("post");
        $this->db->join("kategori","kategori.id_kategori = post.id_kategori","left");
        $this->db->where("post.is_delete","0");
        return $this->db->count_all_results();
    }

}
