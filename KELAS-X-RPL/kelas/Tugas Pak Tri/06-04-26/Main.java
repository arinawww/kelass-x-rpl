public class Main {
    String nama;

    Main(String nama) {
        this.nama = nama;
    }

    void sapa() {
        System.out.println("Hello World!");
    }

    void haloUser(String nama) {
        System.out.println("Halo " + nama + ", selamat datang!");
    }

    // --- Method Overloading Perkalian ---

    // 1. Perkalian dua angka integer
    int Perkalian(int a, int b) {
        return a * b;
    }

    // 2. Perkalian tiga angka integer
    int Perkalian(int a, int b, int c) {
        return a * b * c;
    }

    // 3. Perkalian dua angka pecahan (double)
    double Perkalian(double a, double b) {
        return a * b;
    }

    public static void main(String[] args) {
        Main user1 = new Main("Budi");
        user1.sapa();
        user1.haloUser(user1.nama);

        System.out.println("\n--- Operasi Perkalian ---");
        System.out.println("5 x 10 = " + user1.Perkalian(5, 10));
        System.out.println("2 x 3 x 4 = " + user1.Perkalian(2, 3, 4));
        System.out.println("2.5 x 4.0 = " + user1.Perkalian(2.5, 4.0));
    }
}