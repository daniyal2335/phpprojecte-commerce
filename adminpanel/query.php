<?php
include('dbcon.php');
session_start();

//signup
if(isset($_POST['signUp'])){
    $name=$_POST['uName'];
    $email=$_POST['uEmail'];
    $pass=$_POST['uPassword'];
   $query=$pdo->prepare("insert into users(name,email,password)values(:sName, :sEmail,:sPassword)");
            $query->bindParam('sName',$name);
            $query->bindParam('sEmail',$email);
            $query->bindParam('sPassword',$pass);
            $query->execute();
            $user=$query->fetch(PDO::FETCH_ASSOC);
            print_r($user);
            echo "<script>alert('register added successfully');
        location.assign('signin.php');
        </script>";
        }
    


//add category
if(isset($_POST['addCategory'])){
    $cName=$_POST['cName'];
    $cDes=$_POST['cDes'];
    $cImageName=$_FILES['cImage']['name'];
    $cImageTmpName=$_FILES['cImage']['tmp_name'];
    $extension=pathinfo($cImageName,PATHINFO_EXTENSION);
    $destination="img/".$cImageName;
    if($extension == "jpg"|| $extension == "png"|| $extension == "jpeg"){
        if(move_uploaded_file($cImageTmpName,$destination)){
            $query=$pdo->prepare("insert into category(name,des,image)values(:cName, :cDes, :cImage)");
            $query->bindParam('cName',$cName);
            $query->bindParam('cDes',$cDes);
            $query->bindParam('cImage',$cImageName);
            $query->execute();
            echo "<script>alert('Category added successfully');
        location.assign('index.php');
        </script>";
        }
    }

}
//update category
if(isset($_POST['updateCategory'])){
    $id=$_GET['cid'];
    $cName=$_POST['cName'];
    $cDes=$_POST['cDes'];
    $query=$pdo->prepare("update category set name=:uName,des=:uDes where id=:cid");
    if(isset($_FILES['cImage'])){
        $cImageName=$_FILES['cImage']['name'];
        $cImageTmpName=$_FILES['cImage']['tmp_name'];
        $extension=pathinfo($cImageName,PATHINFO_EXTENSION);
        $destination="img/".$cImageName;
        if($extension == "jpg"|| $extension == "png"|| $extension == "jpeg"){
            if(move_uploaded_file($cImageTmpName,$destination)){
                $query=$pdo->prepare("update category set name=:uName,des=:uDes,image=:uImage where id=:cid");
                $query->bindParam('uImage',$cImageName);  
    }
}
   
            $query->bindParam('cid',$id);
            $query->bindParam('uName',$cName);
            $query->bindParam('uDes',$cDes);
            $query->execute();
            echo "<script>alert('Category update successfully');
        location.assign('viewCategory.php');
        </script>";
        }
    }
    //delete catgeory
if(isset($_GET['cdid'])){
    $did=$_GET['cdid'];
    $query=$pdo->prepare("delete from category where id=:did");
    $query->bindParam('did',$did);
    $query->execute();
    echo "<script>alert('delete category successfully');
    location.assign('viewCategory.php');
    </script>";

}
//addproduct
if(isset($_POST['addProduct'])){
    $pName=$_POST['pName'];
    $pDes=$_POST['pDes'];
    $price=$_POST['pPrice'];
    $qty=$_POST['pQty'];
    $cid=$_POST['cId'];
    $pImageName=$_FILES['pImage']['name'];
    $pImageTmpName=$_FILES['pImage']['tmp_name'];
    $extension=pathinfo($pImageName,PATHINFO_EXTENSION);
    $destination="img/".$pImageName;
    if($extension == "jpg"|| $extension == "png"|| $extension == "jpeg" || $extension == "webp"){
        if(move_uploaded_file($pImageTmpName,$destination)){
            $query=$pdo->prepare("insert into products(name,des,prize,quantity,image,c_id)values(:pName, :pDes, :pPrz, :pQty, :pImage, :cid)");
            $query->bindParam('pName',$pName);
            $query->bindParam('pDes',$pDes);
            $query->bindParam('pPrz',$price);
            $query->bindParam('pQty',$qty);
            $query->bindParam('pImage',$pImageName);
            $query->bindParam('cid',$cid);
            $query->execute();
            echo "<script>alert('Product added successfully');
        location.assign('index.php');
        </script>";
        }
    }

}
//update product
if(isset($_POST['updateProduct'])){
    $id=$_GET['pid'];
    $Name=$_POST['pName'];
    $Des=$_POST['pDes'];
    $Price=$_POST['pPrice'];
    $Qty=$_POST['pQty'];
    $cId=$_POST['cId'];
    $query=$pdo->prepare("update products set name=:uName,des=:uDes,prize=:uPrice,quantity=:uQty,c_id=:cId where id=:pid");
    if(isset($_FILES['pImage'])){
        $pImageName=$_FILES['pImage']['name'];
        $pImageTmpName=$_FILES['pImage']['tmp_name'];
        $extension=pathinfo($pImageName,PATHINFO_EXTENSION);
        $destination="img/".$pImageName;
        if($extension == "jpg"|| $extension == "png"|| $extension == "jpeg" || $extension == "webp"){
            if(move_uploaded_file($pImageTmpName,$destination)){
                $query=$pdo->prepare("update products set name=:uName,des=:uDes,prize=:uPrice,quantity=:uQty,c_id=:cId,
                image=:uImage where id=:pid");
                $query->bindParam('uImage',$pImageName);  
    }
}
   
            $query->bindParam('pid',$id);
            $query->bindParam('uName',$Name);
            $query->bindParam('uDes',$Des);
            $query->bindParam('uPrice',$Price);
            $query->bindParam('uQty',$Qty);
            $query->bindParam('cId',$cId);
            $query->execute();
            echo "<script>alert(' update product successfully');
        location.assign('viewProduct.php');
        </script>";
        }
    }
     //delete catgeory
if(isset($_GET['pdid'])){
    $pdid=$_GET['pdid'];
    $query=$pdo->prepare("delete from products where id=:pdid");
    $query->bindParam('pdid',$pdid);
    $query->execute();
    echo "<script>alert('delete product successfully');
    location.assign('viewProduct.php');
    </script>";

}
?>