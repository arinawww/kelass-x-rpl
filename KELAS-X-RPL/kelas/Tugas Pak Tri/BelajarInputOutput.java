import java.util.Scanner;




public class BelajarInputOutput {
    
    public static void main(String[] args) {
            
            Scanner inputUser= new Scanner(System.in);
                System.out.print("Inputkan Nama Anda:");
            String nama= inputUser.nextLine();
                System.out.println("Nama Yang di Input: "+nama);
                
                System.out.print("Berapakah Absen Anda: ");
            int absen= inputUser.nextInt();
                System.out.println("Nomer Absen Anda: "+absen);
                
                System.out.print("berapakah uang sakumu: ");
            double uang= inputUser.nextDouble();
                System.out.println("uang sakuku: Rp."+uang);
                
            Scanner masukan= new Scanner(System.in);
                System.out.print("karakter apa yang km suka: ");
            String simbol= masukan.nextLine();
                System.out.println("karakter yg km suka: "+simbol);
               
    }
}
