#include <SPI.h>
#include <MFRC522.h>

#define SS_PIN 53  // Pino para SDA (SS) no Arduino Mega
#define RST_PIN 8

MFRC522 mfrc522(SS_PIN, RST_PIN);

void setup() {
  Serial.begin(9600);
  SPI.begin();
  mfrc522.PCD_Init();
}

void loop() {
  if (mfrc522.PICC_IsNewCardPresent() && mfrc522.PICC_ReadCardSerial()) {
    Serial.println("Card detected!");

    String cardUID = "";
    for (byte i = 0; i < mfrc522.uid.size; i++) {
      cardUID += String(mfrc522.uid.uidByte[i], HEX);
    }

    Serial.print("Card UID: ");
    Serial.println(cardUID);

    delay(1000);
  }
}
