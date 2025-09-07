<?php
class Auction
{
    public $host = "127.0.0.1";
    public $nama = "dbauction";
    public $user = "root";
    public $pass = "";
    public $db;

    public function __construct()
    {
        $this->db = new PDO(
            "mysql:host={$this->host};dbname={$this->nama}",
            $this->user,
            $this->pass
        );
    }

    public function cekLoginUser($usn, $pw)
    {
        $query = $this->db->prepare(
            "SELECT * FROM tbuser WHERE nama = :nama AND password = :password"
        );
        $query->bindParam(":nama", $usn);
        $query->bindParam(":password", $pw);
        $query->execute();

        $data = $query->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            return $data;
        } else {
            return false; 
        }
    }

    public function cekLoginAdmin($usn, $pw)
    {
        $query = $this->db->prepare(
            "SELECT * FROM tbadmin WHERE nama = :nama AND password = :password"
        );
        $query->bindParam(":nama", $usn);
        $query->bindParam(":password", $pw);
        $query->execute();
        $data = $query->fetch();
        if ($data) {
            return true;
        } else {
            return false;
        }
    }

    public function tampilkanDataUser()
    {
        $query = $this->db->prepare(
            "SELECT * FROM tbuser"
        );

        $query->execute();

        $data = $query->fetchAll();

        return $data;
    }

    public function simpanLogin($a, $b, $c)
    {
        $query = $this->db->prepare(
            "INSERT INTO tbuser (nama,password,no_rekening) VALUES(:nama, :password, :no_rekening)"
        );
        $query->bindParam(":nama", $a);
        $query->bindParam(":password", $b);
        $query->bindParam(":no_rekening", $c);

        if ($query->execute())
            return true;
        else
            return false;
    }

    public function tampilkanDataUserById($id)
    {
        $query = $this->db->prepare(
            "SELECT * FROM tbuser WHERE id=:id"
        );
        $query->bindParam(":id", $id);
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }

    public function hapusDataUser($id)
    {
        $query = $this->db->prepare(
            "DELETE FROM tbuser WHERE id=:id"
        );
        $query->bindParam(":id", $id);

        if ($query->execute())
            return true;
        else
            return false;
    }

    public function tampilkanBarang()
    {
        $query = $this->db->prepare(
            "SELECT id, foto_barang, nama_barang, deskripsi_barang, harga_awal 
            FROM tbbarang 
            WHERE status_lelang IN ('on_going')"
        );

        $query->execute();

        $data = $query->fetchAll();

        return $data;
    }


    public function tampilkanDetailBarangById($id)
    {
        $query = $this->db->prepare(
            "SELECT * FROM tbbarang WHERE  id=:id"
        );
        $query->bindParam(":id", $id);
        $query->execute();
        $data = $query->fetchAll();
        return $data;
    }

    public function ajukanBarang($a, $b, $c, $d, $e, $f)
    {
        $f = 'pending';
        $query = $this->db->prepare(
            "INSERT INTO tbbarang (nama_barang, deskripsi_barang, harga_awal, harga_buyout, foto_barang, status_lelang) VALUES(:nama_barang, :deskripsi_barang, :harga_awal, :harga_buyout, :foto_barang, :status_lelang)"
        );
        $query->bindParam(":nama_barang", $a);
        $query->bindParam(":deskripsi_barang", $b);
        $query->bindParam(":harga_awal", $c);
        $query->bindParam(":harga_buyout", $d);
        $query->bindParam(":foto_barang", $e);
        $query->bindParam(":status_lelang", $f);

        if ($query->execute())
            return true;
        else
            return false;
    }

    public function tampilkanVerifBarang()
    {
        $query = $this->db->prepare(
            "SELECT * FROM tbbarang WHERE status_lelang = 'pending'"
        );


        $query->execute();

        $data = $query->fetchAll();

        return $data;
    }

    public function hapusDataPengajuan($id)
    {
        $query = $this->db->prepare(
            "DELETE FROM tbbarang WHERE id=:id"
        );
        $query->bindParam(":id", $id);

        if ($query->execute())
            return true;
        else
            return false;
    }

    public function pengajuanDiterima($a)
    {
        $query = $this->db->prepare(
            "UPDATE tbbarang SET status_lelang='on_going' WHERE id=:id"
        );
        $query->bindParam(":id", $a);

        if ($query->execute())
            return true;
        else
            return false;
    }

    public function tampilkanBarangUrut()
    {
        $query = $this->db->prepare(
            "SELECT id, nama_barang, deskripsi_barang, harga_awal, status_lelang
            FROM tbbarang 
            ORDER BY status_lelang;"
        );

        $query->execute();

        $data = $query->fetchAll();

        return $data;
    }

    public function ajukanBid($id_barang, $bid_amount, $user_id)
    {
        $query = $this->db->prepare("SELECT * FROM tbbarang WHERE id = :id");
        $query->bindParam(":id", $id_barang);
        $query->execute();
        $barang = $query->fetch();

        if ($barang) {
            $query = $this->db->prepare("SELECT bid_amount FROM tb_bid WHERE id_barang = :id_barang ORDER BY created_at DESC LIMIT 1");
            $query->bindParam(":id_barang", $id_barang);
            $query->execute();
            $lastBid = $query->fetch();

            $minimumBid = isset($lastBid['bid_amount']) ? max($barang['harga_awal'], $lastBid['bid_amount']) : $barang['harga_awal'];

            if ($bid_amount > $minimumBid) {
                $query = $this->db->prepare("INSERT INTO tb_bid (id_barang, bid_amount, created_at, user_id) VALUES (:id_barang, :bid_amount, NOW(), :user_id)");
                $query->bindParam(":id_barang", $id_barang);
                $query->bindParam(":bid_amount", $bid_amount);
                $query->bindParam(":user_id", $user_id);
                return $query->execute();
            } else {
                return false;
            }
        }
        return false;
    }
    public function getAllItems()
    {
        
        $query = $this->db->prepare("SELECT * FROM tbbarang");

        $query->execute();

        $data = $query->fetchAll(PDO::FETCH_ASSOC);

        return $data;
    }

    public function tampilkanBidsByBarangId($id_barang)
    {
        $query = $this->db->prepare("SELECT b.bid_amount, b.created_at, u.nama
        FROM tb_bid b
        JOIN tbuser u ON b.user_id = u.id
        WHERE b.id_barang = :id_barang
        ORDER BY b.created_at DESC");
        $query->bindParam(":id_barang", $id_barang, PDO::PARAM_INT); 
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }


    public function ubahStatusBarang($id_barang, $status)
    {
        $query = $this->db->prepare("UPDATE tbbarang SET status_lelang = :status WHERE id = :id");
        $query->bindParam(":status", $status);
        $query->bindParam(":id", $id_barang);
        return $query->execute();
    }

    public function getHighestBid($id_barang)
    {
        $query = $this->db->prepare("
        SELECT b.bid_amount, b.user_id, u.nama AS nama_pengguna 
        FROM tb_bid b
        JOIN tbuser u ON b.user_id = u.id
        WHERE b.id_barang = :id_barang 
        ORDER BY b.bid_amount DESC 
        LIMIT 1
    ");
        $query->bindParam(":id_barang", $id_barang);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function prosesPembayaran($id_barang, $user_id)
    {
        $highestBid = $this->getHighestBid($id_barang);

        if ($highestBid && $highestBid['user_id'] == $user_id) {
            $query = $this->db->prepare("UPDATE tbbarang SET status_lelang = 'paid' WHERE id = :id_barang");
            $query->bindParam(":id_barang", $id_barang);
            return $query->execute();
        }
        return false; 
    }

    public function akhiriLelang($id_barang)
    {
        return $this->ubahStatusBarang($id_barang, 'sold');
    }

    public function tampilkanBarangFull()
    {
        $query = $this->db->prepare(
            "SELECT id, foto_barang, nama_barang, deskripsi_barang, harga_awal, status_lelang 
        FROM tbbarang WHERE status_lelang IN ('on_going')
       "
        );

        $query->execute();

        $data = $query->fetchAll();

        return $data;
    }

    public function ubahStatusLelangAfterBid($id_barang, $bid_amount)
    {
        $query = $this->db->prepare(
            "SELECT harga_buyout FROM tbbarang WHERE id= :id"
        );
        $query->bindParam(":id", $id_barang);
        $query->execute();
        $barang = $query->fetch();

        if ($barang) {
            if ($bid_amount >= $barang['harga_buyout']) {
                $updateQuery = $this->db->prepare("UPDATE tbbarang SET status_lelang = 'sold' WHERE id = :id");
                $updateQuery->bindParam(":id", $id_barang);
                $updateQuery->execute();
                return true; 
            }
        }
        return false;
    }

    public function tampilkanBarangSold()
    {
        $query = $this->db->prepare(
            "SELECT id, foto_barang, nama_barang, deskripsi_barang, harga_awal, status_lelang 
        FROM tbbarang 
        WHERE status_lelang IN ('sold')"
        );

        $query->execute();

        $data = $query->fetchAll();

        return $data;
    }

}
