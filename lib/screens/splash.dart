import 'package:flutter/material.dart';
import 'package:posyandu/screens/auth/login_screen.dart'; // Update path sesuai struktur folder

class SplashScreen extends StatefulWidget {
  @override
  _SplashScreenState createState() => _SplashScreenState();
}

class _SplashScreenState extends State<SplashScreen> {
  @override
  void initState() {
    super.initState();
    // Delay selama 3 detik, lalu navigasi ke halaman login
    Future.delayed(Duration(seconds: 3), () {
      Navigator.pushReplacement(
        context,
        MaterialPageRoute(builder: (context) => LoginScreen()),
      );
    });
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      backgroundColor: Colors.white, // Warna background splash screen
      body: Center(
        child: Image.asset(
          'assets/logo.jpg', // Logo splash screen
          width: 200,
          height: 200,
        ),
      ),
    );
  }
}
