#include <SoftwareSerial.h>
#include <MySQL_Connection.h>

SoftwareSerial bluetooth(10, 11);  // RX, TX
MySQL_Connection conn((Client *)&bluetooth);

char user[] = "root";
char password[] = "";
char dbname[] = "pap-maquina-de-vendas";
char server[] = "localhost";

void setup() {
  Serial.begin(9600);
  bluetooth.begin(9600);

  IPAddress serverAddress;
  if (serverAddress.fromString(server)) {
    Serial.println("Conectando ao banco de dados...");

    if (conn.connect(serverAddress, 3306, user, password, dbname)) {
      Serial.println("Conexão bem-sucedida!");
    } else {
      Serial.println("Falha na conexão ao banco de dados.");
    }
  } else {
    Serial.println("Endereço do servidor inválido.");
  }
}

void loop() {
  // Se precisar adicionar lógica adicional, você pode fazer aqui
  delay(1000);  // Aguarde um curto período antes de tentar novamente
}
