
public class Siswa {
    Siswa () {
        System.out.println("ini adalah Constructor-1");
    }
    
    Siswa (String nama) {
        System.out.println("ini Constructor-2");
        System.out.println("nama saya adalah: "+nama);
    }
    
    Siswa (String nama, int usia){
        System.out.println("ini Constructor-3");
        System.out.println("Nama Saya adalah: "+nama);
        System.out.println("Umur saya "+usia);
    }
    
    Siswa(String nama, int usia, String alamat){
        System.out.println("ini Constructor-4");
        System.out.println("Nama saya adalah: "+nama);
        System.out.println("usia saya adalah: "+usia);
        System.out.println("saya bertempat tinggal di: "+alamat);
    }
}
