# CodigoBarrasPHP
Geração de código de barras em PHP com imagecreatetruecolor e retorno de base64 da imagem criada

Usei como base o código encontrado no seguinte blog: http://taylorlopes.com/gerando-codigo-de-barras-com-php.
Esta função retorna o base64 da imagem para usar no html.
Caso precise salvar as imagens do código de barras são alterações mínimas também.

Por padrão, criei a imagem como gif, mas pode ser qualquer imagem suportada pelo php à partir de uma imagem GD.
Em caso de incompatibilidade com a função imagecreatetruecolor(), poderá substituí-la pela imagecreate() sem problema algum, com os mesmos parâmetros.
