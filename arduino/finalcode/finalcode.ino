#include <SPI.h>
#include <MFRC522.h>

#define SS_PIN 53  // Pino para SDA (SS) no Arduino Mega
#define RST_PIN 8
#define BUTTON_PIN 22 // Pino do botão

MFRC522 mfrc522(SS_PIN, RST_PIN);

void setup() {
  Serial.begin(9600);
  SPI.begin();
  mfrc522.PCD_Init();
  pinMode(BUTTON_PIN, INPUT_PULLUP);
}

void loop() {
  // Verificar se o botão foi pressionado
  if (digitalRead(BUTTON_PIN) == LOW) {
    // Adicione aqui a lógica para descontar o preço do produto
    // Certifique-se de enviar um comando específico para o Node-RED, por exemplo, 'B'
    Serial.println("B");
    delay(1000); // Aguarde um pouco para evitar leituras múltiplas
  }

  // Lógica RFID aqui...
  if (mfrc522.PICC_IsNewCardPresent() && mfrc522.PICC_ReadCardSerial()) {
    String cardUID = "";
    for (byte i = 0; i < mfrc522.uid.size; i++) {
      cardUID += String(mfrc522.uid.uidByte[i], HEX);
    }

    // Envia o UID para o computador via porta serial
    Serial.println(cardUID);

    // Aguarda um pouco para evitar leituras múltiplas
    delay(1000);
  }
}
