$(function(){
  $('#wave-upper').wavify({
    height: 40,
    bones: 2,
    amplitude: 50,
    color: 'rgba(86, 190, 237, 0.57)',
    speed: .35
    });

    $('#wave-under').wavify({
      height: 60,
      bones: 3,
      amplitude: 40,
      color: 'rgba(29, 147, 233, 1.0)',
      speed: .25
      });

//----パーティクル表示部---------------------------------------------------------
//=====サイトトップ部============================================================
particlesJS('iphone-bubble',{
  "particles":{
//--シェイプの設定----------
      "number":{
        "value":50, //シェイプの数
        "density":{
          "enable":true, //シェイプの密集度を変更するか否か
          "value_area":400 //シェイプの密集度
        }
      },
      "shape":{
        "type":"circle", //シェイプの形（circle:丸、edge:四角、triangle:三角、polygon:多角形、star:星型、image:画像）
        "stroke":{
          "width":0, //シェイプの外線の太さ
          "color":"#ffcc00" //シェイプの外線の色
        },
        //typeをpolygonにした時の設定
        "polygon": {
          "nb_sides": 5 //多角形の角の数
        },
        //typeをimageにした時の設定
        "image": {
          "src": "images/hoge.png",
          "width": 5,
          "height": 50
        }
      },
      "color":{
        "value":"random" //シェイプの色
      },
      "opacity":{
        "value":0.6, //シェイプの透明度
        "random":false, //シェイプの透明度をランダムにするか否か
        "anim":{
          "enable":false, //シェイプの透明度をアニメーションさせるか否か
          "speed":3, //アニメーションのスピード
          "opacity_min":0.9, //透明度の最小値
          "sync":true //全てのシェイプを同時にアニメーションさせるか否か
        }
      },
      "size":{
        "value":10, //シェイプの大きさ
        "random":false, //シェイプの大きさをランダムにするか否か
        "anim":{
          "enable":false, //シェイプの大きさをアニメーションさせるか否か
          "speed":4, //アニメーションのスピード
          "size_min":10, //大きさの最小値
          "sync":false //全てのシェイプを同時にアニメーションさせるか否か
        }
      },
//--------------------

//--線の設定----------
      "line_linked":{
        "enable":false, //線を表示するか否か
        "distance":25, //線をつなぐシェイプの間隔
        "color":"#A4C6FF", //線の色
        "opacity":0.8, //線の透明度
        "width":1 //線の太さ
      },
//--------------------

//--動きの設定----------
      "move":{
        "speed":3, //シェイプの動くスピード
        "straight":false, //個々のシェイプの動きを止めるか否か
        "direction":"none", //エリア全体の動き(none、top、top-right、right、bottom-right、bottom、bottom-left、left、top-leftより選択)
        "out_mode":"out" //エリア外に出たシェイプの動き(out、bounceより選択)
      }
//--------------------

    },

    "interactivity":{
      "detect_on":"canvas",
      "events":{

//--マウスオーバー時の処理----------
        "onhover":{
          "enable":false, //マウスオーバーが有効か否か
          "mode":"repulse" //マウスオーバー時に発動する動き(下記modes内のgrab、repulse、bubbleより選択)
        },
//--------------------

//--クリック時の処理----------
        "onclick":{
          "enable":true, //クリックが有効か否か
          "mode":"push" //クリック時に発動する動き(下記modes内のgrab、repulse、bubble、push、removeより選択)
        },
//--------------------

      },

      "modes":{

//--カーソルとシェイプの間に線が表示される----------
        "grab":{
          "distance":400, //カーソルからの反応距離
          "line_linked":{
            "opacity":1 //線の透明度
          }
        },
//--------------------

//--シェイプがカーソルから逃げる----------
        "repulse":{
          "distance":200 //カーソルからの反応距離
        },
//--------------------

//--シェイプが膨らむ----------
        "bubble":{
          "distance":400, //カーソルからの反応距離
          "size":40, //シェイプの膨らむ大きさ
          "opacity":8, //膨らむシェイプの透明度
          "duration":2, //膨らむシェイプの持続時間(onclick時のみ)
          "speed":3 //膨らむシェイプの速度(onclick時のみ)
        },
//--------------------

//--シェイプが増える----------
        "push":{
          "particles_nb":5 //増えるシェイプの数
        },
//--------------------

//--シェイプが減る----------
        "remove":{
          "particles_nb":5 //減るシェイプの数
        }
//--------------------

      }
    },
    "retina_detect":true, //Retina Displayを対応するか否か
    "resize":true //canvasのサイズ変更にわせて拡大縮小するか否か
  }
);
});
