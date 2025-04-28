import 'package:flutter/material.dart';

class StuntingScreen extends StatefulWidget {
  @override
  _StuntingScreenState createState() => _StuntingScreenState();
}

class _StuntingScreenState extends State<StuntingScreen> {
  final _formKey = GlobalKey<FormState>();
  final Map<String, TextEditingController> _controllers = {
    'Nama Pasien': TextEditingController(),
    'Usia (bulan)': TextEditingController(),
    'Tinggi Badan (cm)': TextEditingController(),
    'Berat Badan (kg)': TextEditingController(),
    'Lingkar Kepala (cm)': TextEditingController(),
    'Catatan Tambahan': TextEditingController(),
  };

  @override
  void dispose() {
    _controllers.forEach((key, controller) => controller.dispose());
    super.dispose();
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: Text('Informasi Stunting'),
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: SingleChildScrollView(
          child: Column(
            crossAxisAlignment: CrossAxisAlignment.start,
            children: [
              Text(
                'Apa Itu Stunting?',
                style: TextStyle(fontSize: 20, fontWeight: FontWeight.bold),
              ),
              SizedBox(height: 8),
              Text(
                'Stunting adalah kondisi gagal tumbuh akibat kekurangan gizi dalam waktu lama.',
              ),
              SizedBox(height: 16),
              Text(
                'Ciri-ciri Stunting:',
                style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold),
              ),
              SizedBox(height: 8),
              ...["Tinggi badan lebih pendek", "Pertumbuhan lambat", "Wajah lebih muda", "Kelemahan fisik", "Kesulitan belajar"]
                  .map((ciri) => Padding(
                        padding: const EdgeInsets.symmetric(vertical: 4.0),
                        child: Row(
                          crossAxisAlignment: CrossAxisAlignment.start,
                          children: [
                            Icon(Icons.check, color: Colors.green),
                            SizedBox(width: 8),
                            Expanded(child: Text(ciri)),
                          ],
                        ),
                      )),
              SizedBox(height: 16),
              Form(
                key: _formKey,
                child: Column(
                  children: _controllers.entries.map((entry) {
                    return Padding(
                      padding: const EdgeInsets.symmetric(vertical: 8.0),
                      child: TextFormField(
                        controller: entry.value,
                        decoration: InputDecoration(labelText: entry.key),
                        keyboardType: entry.key.contains('(kg)') ||
                                entry.key.contains('(cm)') ||
                                entry.key.contains('(bulan)')
                            ? TextInputType.number
                            : TextInputType.text,
                        maxLines: entry.key == 'Catatan Tambahan' ? 3 : 1,
                        validator: (value) => value!.isEmpty && entry.key != 'Catatan Tambahan'
                            ? 'Masukkan ${entry.key.toLowerCase()}'
                            : null,
                      ),
                    );
                  }).toList(),
                ),
              ),
              SizedBox(height: 16),
              ElevatedButton(
                onPressed: () {
                  if (_formKey.currentState!.validate()) {
                    // Proses data
                  }
                },
                child: Text('Simpan Data Pasien'),
              ),
            ],
          ),
        ),
      ),
    );
  }
}
