#include <SoftwareSerial.h>

SoftwareSerial bluetooth(10, 11);  // RX, TX

void setup() {
  Serial.begin(9600);
  bluetooth.begin(9600);

  Serial.println("Conexão Bluetooth estabelecida!");
}

void loop() {
  if (bluetooth.available()) {
    char data = bluetooth.read();
    Serial.print("Recebido via Bluetooth: ");
    Serial.println(data);
  }

  if (Serial.available()) {
    char data = Serial.read();
    Serial.print("Enviado para Bluetooth: ");
    Serial.println(data);
    bluetooth.print(data);
  }
}
