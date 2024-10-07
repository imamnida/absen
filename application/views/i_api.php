<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Documentation - Attendance System</title>
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/images/gi.png" />
    <style>
        :root {
            --primary-color: #000;
            --secondary-color: #f6f6f6;
            --text-color: #333;
            --background-color: #fff;
            --code-background: #1e1e1e;
            --code-color: #d4d4d4;
            --border-color: #e0e0e0;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background-color: var(--background-color);
        }

        .container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: var(--secondary-color);
            color: var(--text-color);
            padding: 20px;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
            border-right: 1px solid var(--border-color);
        }

        .sidebar h2 {
            margin-bottom: 20px;
            font-size: 1.2em;
            font-weight: 600;
        }

        .sidebar ul {
            list-style-type: none;
        }

        .sidebar ul li {
            margin-bottom: 10px;
        }

        .sidebar ul li a {
            color: var(--text-color);
            text-decoration: none;
            font-size: 0.9em;
            transition: color 0.3s ease;
        }

        .sidebar ul li a:hover {
            color: #007aff;
        }

        .content {
            flex: 1;
            padding: 40px;
            margin-left: 250px;
        }

        h1, h2, h3 {
            margin-bottom: 20px;
            color: var(--primary-color);
        }

        h1 {
            font-size: 2em;
            font-weight: 700;
        }

        h2 {
            font-size: 1.5em;
            font-weight: 600;
            border-bottom: 1px solid var(--border-color);
            padding-bottom: 10px;
        }

        h3 {
            font-size: 1.2em;
            font-weight: 600;
        }

        p {
            margin-bottom: 15px;
        }

        pre {
            background-color: var(--code-background);
            border-radius: 6px;
            padding: 15px;
            overflow-x: auto;
            margin-bottom: 20px;
        }

        code {
            font-family: 'SFMono-Regular', Consolas, 'Liberation Mono', Menlo, Courier, monospace;
            font-size: 0.9em;
            color: var(--code-color);
        }

        .endpoint {
            background-color: var(--background-color);
            border: 1px solid var(--border-color);
            border-radius: 6px;
            padding: 20px;
            margin-bottom: 30px;
        }

        .endpoint h3 {
            border-bottom: none;
            padding-bottom: 0;
            margin-bottom: 10px;
        }

        .method {
            display: inline-block;
            padding: 3px 6px;
            border-radius: 4px;
            font-weight: 600;
            margin-right: 10px;
            font-size: 0.8em;
            text-transform: uppercase;
        }

        .get {
            background-color: #61affe;
            color: #fff;
        }

        .post {
            background-color: #49cc90;
            color: #fff;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            text-align: left;
            padding: 12px;
            border-bottom: 1px solid var(--border-color);
        }

        th {
            background-color: var(--secondary-color);
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                height: auto;
                position: static;
            }
            .content {
                margin-left: 0;
                padding: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <nav class="sidebar">
            <h2>API Documentation</h2>
            <ul>
                <li><a href="#overview">Overview</a></li>
                <li><a href="#authentication">Authentication</a></li>
                <li><a href="#endpoints">Endpoints</a>
                    <ul>
                        <li><a href="#get-device-mode">Get Device Mode</a></li>
                        <li><a href="#register-new-card">Register New Card</a></li>
                        <li><a href="#record-attendance">Record Attendance</a></li>
                    </ul>
                </li>
                <li><a href="#raspberry-pi-implementation">Raspberry Pi Implementation</a></li>
                <li><a href="#esp32-implementation">ESP32 Implementation</a></li>
            </ul>
        </nav>
        <main class="content">
            <h1>API Documentation for Attendance System</h1>
            
            <section id="overview">
                <h2>Overview</h2>
                <p>This API provides endpoints for a student-based attendance system. It allows for device mode retrieval, card registration, and attendance tracking.</p>
            </section>

            <section id="authentication">
                <h2>Authentication</h2>
                <p>All API requests require an API key to be passed as a query parameter <code>key</code>.</p>
            </section>

            <section id="endpoints">
                <h2>Endpoints</h2>

                <div class="endpoint" id="get-device-mode">
                    <h3>Get Device Mode</h3>
                    <p>Retrieves the current mode of the device.</p>
                    <p><span class="method get">GET</span> <code>/getmodejson</code></p>
                    <h4>Parameters</h4>
                    <table>
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Description</th>
                        </tr>
                        <tr>
                            <td>key</td>
                            <td>string</td>
                            <td>Your API key (required)</td>
                        </tr>
                        <tr>
                            <td>iddev</td>
                            <td>string</td>
                            <td>The device ID (required)</td>
                        </tr>
                    </table>
                    <h4>Response</h4>
                    <pre><code>{
  "status": "success",
  "mode": "SCAN",
  "ket": "berhasil"
}</code></pre>
                </div>

                <!-- Other endpoints (register-new-card and record-attendance) would follow the same structure -->

            </section>

            <section id="raspberry-pi-implementation">
                <h2>Raspberry Pi Implementation</h2>
                <p>Here's a basic implementation for Raspberry Pi with RFID reader using Python:</p>
                <pre><code>import RPi.GPIO as GPIO
from mfrc522 import SimpleMFRC522
import requests
import json
import time

# Setup
reader = SimpleMFRC522()
BASE_URL = "http://absensi.imamdienul.com/api/"
API_KEY = "your_api_key"
DEVICE_ID = "your_device_id"

def get_device_mode():
    url = f"{BASE_URL}getmodejson?key={API_KEY}&iddev={DEVICE_ID}"
    response = requests.get(url)
    if response.status_code == 200:
        data = response.json()
        return data.get('mode')
    return None

# ... rest of the implementation</code></pre>
            </section>

            <section id="esp32-implementation">
                <h2>ESP32 Implementation</h2>
                <p>Here's a basic implementation for ESP32 with RFID reader:</p>
                <pre><code>#include &lt;WiFi.h&gt;
#include &lt;HTTPClient.h&gt;
#include &lt;ArduinoJson.h&gt;
#include &lt;MFRC522.h&gt;

#define SS_PIN 21
#define RST_PIN 22

const char* ssid = "your_wifi_ssid";
const char* password = "your_wifi_password";
const String iddev = "your_device_id";
const String baseURL = "http://absensi.imamdienul.com/api/";
const String apiKey = "your_api_key";

MFRC522 rfid(SS_PIN, RST_PIN);

void setup() {
  Serial.begin(115200);
  SPI.begin();
  rfid.PCD_Init();
  
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(1000);
    Serial.println("Connecting to WiFi...");
  }
  Serial.println("Connected to WiFi");
}

// ... rest of the implementation</code></pre>
            </section>
        </main>
    </div>
</body>
</html>