/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author ME1JU
 */
public class BelajarOperator1 {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) {
         //operator aritmatika
    int a=10;
    int b=3;
    
    int penjumlahan=a+b;
    int pengurangan=a-b;
    int perkalian=a*b;
    double pembagian=a/b;
    int modulus=a%b;
    
    
    
        System.out.println("hasil penjumlahan 2 angka adalah: "+penjumlahan);
        System.out.println("hasil pengurangan 2 angka adalah: "+pengurangan);
        System.out.println(perkalian);
        System.out.println(pembagian);
        System.out.println(modulus);
        
    //operator penugasan
    //=
    //+=
    //-=
    //*=
    //%=
    
    int c=20;
    
    c +=5;
    a-=2;
    b*=100;
    
        System.out.println(c);
        System.out.println(a);
        System.out.println(b);
        System.out.println("");
        System.out.println("");
        
        
        
    //operator pembanding
    
    int d=50;
    int e=10;
    
    boolean hasil= d==e;
    boolean hasil1= d>=e;
    boolean hasil2= d!=e;
    boolean hasil3= d<=e;
    
    
        System.out.println(hasil);
        System.out.println(hasil1);
        System.out.println(hasil2);
        System.out.println(hasil3);
        
    //operator logika
    boolean result = true && true;
    boolean result2 = d>e && d==e;
    boolean result3 = true || true ;
    boolean result4 = d!=e || d<e;
    
        System.out.println("operator logika-1 "+result);
        System.out.println("operator logika-2 "+result2);
        System.out.println("operator logika-3 "+result3);
        System.out.println("operator logika-4 "+result4);
        
        
    }
    
}
