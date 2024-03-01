<?php

namespace misterxin\tool;

class FileSql
{
    private $filename; // 文件名
    private $data = []; // 数据数组

    // 构造函数接收文件名并读取数据
    public function __construct($filename)
    {
        $this->filename = $filename;
        if (file_exists($filename)) {
            $this->data = include_once($filename);
        }
    }

    // 析构函数在对象销毁前保存数据
    public function __destruct()
    {
        $str = "<?php\nreturn ".var_export($this->data, true).";";
        if (!file_exists($this->filename)) {
            (new File)->createFile($this->filename,$str);
        }else{
            file_put_contents($this->filename, $str);
        }
        
    }

    // 查询所有记录
    public function selectAll()
    {
        return $this->data;
    }

    // 根据主键查询一条记录
    public function select($id)
    {
        return isset($this->data[$id]) ? $this->data[$id] : null;
    }

    // 添加一条记录
    public function insert($record)
    {
        $id = count($this->data) + 1;
        $record['id'] = $id;
        $this->data[$id] = $record;
        return $id;
    }

    // 更新一条记录
    public function update($id, $record)
    {
        if (isset($this->data[$id])) {
            $record['id'] = $id;
            $this->data[$id] = $record;
            return true;
        } else {
            return false;
        }
    }

    // 根据主键删除一条记录
    public function delete($id)
    {
        if (isset($this->data[$id])) {
            unset($this->data[$id]);
            return true;
        } else {
            return false;
        }
    }
}
