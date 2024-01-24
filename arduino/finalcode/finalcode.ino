#include <SPI.h>
#include <MFRC522.h>

#define SS_PIN 53       // Pino para SDA (SS) no Arduino Mega
#define RST_PIN 8

MFRC522 mfrc522(SS_PIN, RST_PIN);

void setup() {
  Serial.begin(9600);
  SPI.begin();
  mfrc522.PCD_Init();
  delay(1000);
}

void loop() {
  if (mfrc522.PICC_IsNewCardPresent() && mfrc522.PICC_ReadCardSerial()) {
    Serial.println("Cartão Detectado!");

    String cardUID = "";
    for (byte i = 0; i < mfrc522.uid.size; i++) {
      cardUID += String(mfrc522.uid.uidByte[i], HEX);
    }

    Serial.print("Card UID: ");
    Serial.println(cardUID);

    // Envia o UID para o Node-RED via porta serial
    Serial.print("UID:");
    Serial.println(cardUID);

    // Aguarda a resposta do Node-RED
    while (Serial.available() == 0) {
      // Aguarda a resposta
    }

    // Lê e exibe o saldo recebido pela porta serial
    String saldoData = Serial.readStringUntil('\n');
    if (saldoData.startsWith("Saldo:")) {
      String saldo = saldoData.substring(6);
      Serial.print("Saldo Atual: ");
      Serial.println(saldo);
    }

    delay(1000);
  }
}
