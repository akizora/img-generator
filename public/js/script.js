function buttonClick(){
  alert('Click');
  var test_context = document.getElementById('test_canvas').getContext('2d');

  var image_data = test_context.createImageData(256, 256);

  image_data.data[(128 + 128 * 256) * 4] = 255;
  image_data.data[(128 + 128 * 256) * 4 + 1] = 0;
  image_data.data[(128 + 128 * 256) * 4 + 2] = 0;
  image_data.data[(128 + 128 * 256) * 4 + 3] = 255;

  image_data.data[(129 + 128 * 256) * 4] = 255;
  image_data.data[(129 + 128 * 256) * 4 + 1] = 0;
  image_data.data[(129 + 128 * 256) * 4 + 2] = 0;
  image_data.data[(129 + 128 * 256) * 4 + 3] = 255;

  image_data.data[(128 + 129 * 256) * 4] = 255;
  image_data.data[(128 + 129 * 256) * 4 + 1] = 0;
  image_data.data[(128 + 129 * 256) * 4 + 2] = 0;
  image_data.data[(128 + 129 * 256) * 4 + 3] = 255;

  image_data.data[(129 + 129 * 256) * 4] = 255;
  image_data.data[(129 + 129 * 256) * 4 + 1] = 0;
  image_data.data[(129 + 129 * 256) * 4 + 2] = 0;
  image_data.data[(129 + 129 * 256) * 4 + 3] = 255;

  test_context.putImageData(image_data, 0, 0);
}