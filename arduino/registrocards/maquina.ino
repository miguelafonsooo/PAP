#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <ArduinoJson.h>  // Biblioteca para manipulação de JSON

const char* ssid = "";
const char* password = "sua_senha";
const char* serverUrl = "http://localhost/pap-maquina-de-vendas/php/php/config.php";

void setup() {
    Serial.begin(115200);
    WiFi.begin(ssid, password);

    while (WiFi.status() != WL_CONNECTED) {
        delay(1000);
        Serial.println("Conectando ao WiFi...");
    }
}

void loop() {
    HTTPClient http;
    http.begin(serverUrl);

    int httpCode = http.GET();
    if (httpCode > 0) {
        if (httpCode == HTTP_CODE_OK) {
            String response = http.getString();
            // Analisa a resposta JSON
            DynamicJsonDocument jsonDoc(1024);
            deserializeJson(jsonDoc, response);
            const char* username = jsonDoc["Username"];
            const char* email = jsonDoc["Email"];
            // ... faça algo com as informações do usuário
            Serial.print("Username: ");
            Serial.println(username);
            Serial.print("Email: ");
            Serial.println(email);
        } else {
            Serial.println("Erro na solicitação HTTP");
        }
    }

    http.end();
    delay(5000);  // Aguarda 5 segundos antes da próxima solicitação
}
