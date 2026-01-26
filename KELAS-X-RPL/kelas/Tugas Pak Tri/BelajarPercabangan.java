import java.util.Scanner;

public class BelajarPercabangan {

    public static void main(String[] args) {

        Scanner Inputuser = new Scanner(System.in);

        System.out.print("Inputkan nilai anda: ");
        int nilai = Inputuser.nextInt();

        System.out.println("Nilai anda: " + nilai);

        // Cek lulus / tidak lulus
        if (nilai >= 70) {
            System.out.println("Anda lulus");
        } else {
            System.out.println("Anda tidak lulus");
        }

        // Konversi nilai huruf
        if (nilai >= 90 && nilai <= 100) {
            System.out.println("Grade: A");
        } else if (nilai >= 70 && nilai <= 89) {
            System.out.println("Grade: B");
        } else if (nilai >= 60 && nilai <= 69) {
            System.out.println("Grade: C");
        } else if (nilai >= 50 && nilai <= 59) {
            System.out.println("Grade: D");
        } else if (nilai >= 0 && nilai < 50) {
            System.out.println("Grade: E");
        } else {
            System.out.println("Nilai tidak valid!");
        }
    }
}
