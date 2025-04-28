import 'dart:convert';
import 'package:http/http.dart' as http;
import 'package:shared_preferences/shared_preferences.dart';
import 'package:posyandu/config/api_config.dart';

class AuthService {
  // Data dummy pengguna untuk testing
  final List<Map<String, String>> users = [
    {"nik": "123", "password": "123"},         // Tambahkan credential testing
    {"nik": "654321", "password": "admin123"}, // Tambahkan credential testing
  ];

  // Fungsi untuk login
  Future<Map<String, dynamic>> login({
    required String nik,
    required String password,
  }) async {
    try {
      print('Memulai proses login...');

      final Map<String, String> headers = {
        'Content-Type': 'application/json',
        'Accept': 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
      };

      final Map<String, dynamic> requestBody = {
        'nik': nik,
        'password': password,
      };

      print('Sending login request with headers: $headers');
      print('Sending login request with body: ${json.encode(requestBody)}');

      final response = await http.post(
        Uri.parse(ApiConfig.loginUrl),
        headers: headers,
        body: json.encode(requestBody),
      );

      print('Login Response Status: ${response.statusCode}');
      print('Login Response Body: ${response.body}');

      if (response.statusCode == 200) {
        print('Login berhasil');
        final prefs = await SharedPreferences.getInstance();
        await prefs.remove('token'); // Hapus token sebelumnya

        final data = json.decode(response.body);
        await prefs.setString('token', data['token']); // Simpan token baru

        return {
          'success': true,
          'message': 'Login berhasil',
          'data': {
            'nik': data['pengguna']['nik'],
            'nama_ibu': data['pengguna']['nama_ibu'],
            // Tambahkan data lain yang diperlukan
          },
        };
      } else {
        final data = json.decode(response.body);
        String errorMessage = data['message'] ?? 'Login gagal';
        
        if (data['errors'] != null) {
          errorMessage += '\n${_formatErrors(data['errors'])}';
        }
        
        return {
          'success': false,
          'message': errorMessage,
          'errors': data['errors'],
        };
      }
    } catch (e) {
      print('Error during login: $e');
      return {
        'success': false,
        'message': 'Terjadi kesalahan: $e',
      };
    }
  }

  // Simulasi login tanpa API
  Future<bool> loginOld(String nik, String password) async {
    try {
      print('Login attempt started'); // Tambahan log
      await Future.delayed(Duration(seconds: 1));
      
      bool isValid = users.any((user) {
        print('Checking user: ${user["nik"]}'); // Tambahan log
        return user["nik"] == nik && user["password"] == password;
      });
      
      print('Login validation result: $isValid'); // Tambahan log
      return isValid;
    } catch (e) {
      print('Login error: $e');
      return false;
    }
  }

  // Tambahkan fungsi logout
  Future<bool> logout() async {
    try {
      // Simulasi network delay
      await Future.delayed(Duration(seconds: 1));
      print('User logged out successfully');
      return true;
    } catch (e) {
      print('Logout error: $e');
      return false;
    }
  }

  String _formatErrors(Map<String, dynamic> errors) {
    List<String> errorMessages = [];
    errors.forEach((key, value) {
      if (value is List) {
        errorMessages.add('${key.toUpperCase()}: ${value.join(', ')}');
      } else {
        errorMessages.add('${key.toUpperCase()}: $value');
      }
    });
    return errorMessages.join('\n');
  }
}
