<?php

// Chave de API do OpenWeatherMap (insira sua chave aqui)
$api_key = '86fc491ae64fc9a395354f7e68fb47ed';

// Cidade e país para obter informações meteorológicas
$city = 'New York';
$country = 'US';

// URL da API do OpenWeatherMap
$url = "http://api.openweathermap.org/data/2.5/weather?q={$city},{$country}&appid={$api_key}";

// Inicializar uma solicitação cURL
$ch = curl_init();

// Configurar as opções da solicitação cURL
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Executar a solicitação e obter a resposta
$response = curl_exec($ch);

// Verificar se a solicitação foi bem-sucedida
if ($response === false) {
    echo 'Erro na solicitação cURL: ' . curl_error($ch);
} else {
    // Converter a resposta JSON em um array associativo
    $data = json_decode($response, true);

    // Verificar se os dados foram obtidos com sucesso
    if (isset($data['main']['temp']) && isset($data['weather'][0]['description'])) {
        $temp = $data['main']['temp'] - 273.15; // Converter de Kelvin para Celsius
        $description = $data['weather'][0]['description'];

        // Exibir as informações meteorológicas
        echo "Cidade: {$city}, {$country}<br>";
        echo "Temperatura: {$temp}°C<br>";
        echo "Descrição: {$description}<br>";
    } else {
        echo 'Não foi possível obter os dados meteorológicos.';
    }
}

// Fechar a solicitação cURL
curl_close($ch);
?>
