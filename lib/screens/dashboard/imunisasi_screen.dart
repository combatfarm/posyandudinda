import 'package:flutter/material.dart';

class ImunisasiScreen extends StatelessWidget {
  final List<Map<String, String>> imunisasiData = [
    {
      'name': 'Vaksin Hepatitis B (HB)',
      'status': 'Selesai',
      'date': '10 Januari 2025'
    },
    {'name': 'Vaksin Polio', 'status': 'Selesai', 'date': '10 Januari 2025'},
    {'name': 'Vaksin BCG', 'status': 'Selesai', 'date': '10 Januari 2025'},
    {'name': 'Vaksin DPT', 'status': 'Belum', 'date': '10 Januari 2025'},
    {'name': 'Vaksin Campak', 'status': 'Belum', 'date': '10 Januari 2025'},
  ];

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        backgroundColor: Colors.green[200],
        leading: IconButton(
          icon: Icon(Icons.arrow_back),
          onPressed: () {
            Navigator.pop(context);
          },
        ),
        title: Text('Imunisasi', style: TextStyle(color: Colors.white)),
        elevation: 0,
      ),
      body: Padding(
        padding: const EdgeInsets.all(16.0),
        child: Column(
          crossAxisAlignment: CrossAxisAlignment.start,
          children: [
            Text(
              'Status Imunisasi',
              style: TextStyle(fontSize: 18, fontWeight: FontWeight.bold),
            ),
            SizedBox(height: 10),
            Expanded(
              child: ListView.builder(
                itemCount: imunisasiData.length,
                itemBuilder: (context, index) {
                  final item = imunisasiData[index];
                  return Container(
                    margin: EdgeInsets.only(bottom: 10),
                    padding: EdgeInsets.all(12),
                    decoration: BoxDecoration(
                      color: Colors.green[100],
                      borderRadius: BorderRadius.circular(12),
                    ),
                    child: Column(
                      crossAxisAlignment: CrossAxisAlignment.start,
                      children: [
                        Text(
                          item['name']!,
                          style: TextStyle(
                              fontSize: 16, fontWeight: FontWeight.bold),
                        ),
                        Divider(color: Colors.black),
                        SizedBox(height: 4),
                        Row(
                          mainAxisAlignment: MainAxisAlignment.spaceBetween,
                          children: [
                            Text('Status : ${item['status']}'),
                            Text(item['date']!),
                          ],
                        ),
                      ],
                    ),
                  );
                },
              ),
            ),
          ],
        ),
      ),
    );
  }
}
