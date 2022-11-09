  <?php 


      $data['token_account'] = 'SEU_TOKEN_AQUI';

      $data["customer"]["contacts"][1]["type_contact"] = "H";
      $data["customer"]["contacts"][1]["number_contact"] = "1133221122";
      $data["customer"]["contacts"][2]["type_contact"] = "M";
      $data["customer"]["contacts"][2]["number_contact"] = "11999999999";

      $data["customer"]["addresses"][1]["type_address"] = "B";    
      $data["customer"]["addresses"][1]["postal_code"] = "17000-000";
      $data["customer"]["addresses"][1]["street"] = "Av Themyscira";
      $data["customer"]["addresses"][1]["number"] = "1001";
      $data["customer"]["addresses"][1]["completion"] = "A";
      $data["customer"]["addresses"][1]["neighborhood"] = "Jd das Rochas";
      $data["customer"]["addresses"][1]["city"] = "Themyscira";
      $data["customer"]["addresses"][1]["state"] = "SP";

      $data["customer"]["name"] = "Diana Prince";
      $data["customer"]["birth_date"] = "21/05/1941";
      $data["customer"]["cpf"] = "50235335142";
      $data["customer"]["email"] = "email@cliente.com.br";

      $data["transaction_product"][1]["description"] = "Camiseta Wonder Woman";
      $data["transaction_product"][1]["quantity"] = "1";
      $data["transaction_product"][1]["price_unit"] = "130.00";
      $data["transaction_product"][1]["code"] = "1";
      $data["transaction_product"][1]["sku_code"] = "0001";
      $data["transaction_product"][1]["extra"] = "Informaçã extra";

      $data["transaction"]["available_payment_methods"] = "2,3,4,5,6,7,14,15,16,18,19,21,22,23";   
      $data["transaction"]["order_number"] = "001";   
      $data["transaction"]["customer_ip"] = "127.0.0.1";    
      $data["transaction"]["shipping_type"] = "Sedex";    
      $data["transaction"]["shipping_price"] = "19.80";    
      $data["transaction"]["price_discount"] = "0"; 
      $data["transaction"]["url_notification"] = "http://www.loja.com.br/notificacao/";    
      $data["transaction"]["free"] = "Campo livre";    
      $data["transaction"]["sub_store"] = "LOJA_1";    
    
      $data["payment"]["payment_method_id"] = "6";    


      $url = "https://api.intermediador.sandbox.yapay.com.br/api/v3/transactions/payment";

      ob_start();

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
      curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));

      curl_exec($ch);

      // JSON de retorno  
      $resposta = json_decode(ob_get_contents());
      $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

      ob_end_clean();
      curl_close($ch);

      if($code == "201"){
          //Tratamento dos dados de resposta da consulta.
      }else{
          //Tratamento das mensagens de erro
      }
  ?>