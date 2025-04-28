import 'package:flutter/material.dart';
import 'package:posyandu/services/auth_service.dart';
import 'package:posyandu/screens/auth/login_screen.dart';

class ProfileScreen extends StatelessWidget {
  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Profile'),
        backgroundColor: Colors.green,
      ),
      body: Padding(
        padding: EdgeInsets.all(16.0),
        child: Column(
          children: [
            // Tambahkan widget profil
            CircleAvatar(
              radius: 50,
              backgroundColor: Colors.green[100],
              child: Icon(Icons.person, size: 50, color: Colors.green),
            ),
            SizedBox(height: 20),
            Text(
              'Nama Pengguna',
              style: TextStyle(fontSize: 24, fontWeight: FontWeight.bold),
            ),
            SizedBox(height: 10),
            Text(
              'NIK: 123456789',
              style: TextStyle(fontSize: 16),
            ),
            SizedBox(height: 40),
            ElevatedButton(
              style: ElevatedButton.styleFrom(
                backgroundColor: Colors.red,
                padding: EdgeInsets.symmetric(horizontal: 40, vertical: 15),
              ),
              onPressed: () async {
                // Tampilkan dialog konfirmasi
                bool? confirm = await showDialog<bool>(
                  context: context,
                  builder: (BuildContext context) {
                    return AlertDialog(
                      title: Text('Konfirmasi Logout'),
                      content: Text('Apakah Anda yakin ingin keluar?'),
                      actions: [
                        TextButton(
                          onPressed: () => Navigator.of(context).pop(false),
                          child: Text('Batal'),
                        ),
                        TextButton(
                          onPressed: () => Navigator.of(context).pop(true),
                          child: Text('Ya'),
                        ),
                      ],
                    );
                  },
                );

                if (confirm == true) {
                  bool logoutSuccess = await AuthService().logout();
                  if (logoutSuccess) {
                    // Gunakan MaterialPageRoute
                    Navigator.of(context).pushAndRemoveUntil(
                      MaterialPageRoute(builder: (context) => LoginScreen()),
                      (Route<dynamic> route) => false,
                    );
                  } else {
                    ScaffoldMessenger.of(context).showSnackBar(
                      SnackBar(content: Text('Gagal logout. Silakan coba lagi.')),
                    );
                  }
                }
              },
              child: Text(
                'Logout',
                style: TextStyle(
                  color: Colors.white,
                  fontSize: 16,
                ),
              ),
            ),
          ],
        ),
      ),
    );
  }
} 