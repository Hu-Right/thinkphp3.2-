<?php
// return [///真实环境
// 	 'Alipay'=>array(
// 	        'app_id' => "2018091761455233",
// 			//商户私钥，您的原始格式RSA私钥
// 			'merchant_private_key' => "MIIEpQIBAAKCAQEA+eyqX3Rf9CH+Wm076oPmpexS+aL2cS8zGlyfYNXrjreS56PTJnvxr2xIiqN+vZBoU81pYG+1L8FE9FlTwCwDGMS+bb1p0cRyrKzLla3lRNx0qGdRchQIzpjV0PcPPPsxMyY/9dRYlsoiEquGWw9oEko5EUnqjwx11nYuSajawPGLx5UziGx6CGtJ1S2rhgVQ/TkAXIid776A7jGXhPyBTRHiPIyJkXEmK5/u7LAZmuhUmQsttM/hNkXwcfgTz2ML1tXX8f5QSjbC0gcRBmxghLCTtVAcKWo3vr/e03MJhC+ypvzCCmlLVRwahhd40zUbZguu572lGQNGZummMgmwkwIDAQABAoIBAQCm1RkWBzVWXqrP6kMo1UvOTudExUgFXiCa5GFv3t0Ts+9Yub9l3S8EjyANi/46xH8gEerZ+TfV3QoOouKJUdfvXMZRszNEWALEycRM8nwtb4xgLjfsEvueDeANUh7V8khxgIMJsupAHkaId/+EIdCzBOD7bYAqZYLz2ogjm5gLWuDiSDI+o+Mtrxc9MPCZzytRD4AGyUhu9yNR5Ew6QYUgnzZ8KI6Jn8GOCzUqwX63GfNPLTkLqexcGqBjURdoyJ+Tb+Rpzm+cWcm6ry7/qyvGwUkxXV+jyyDkrC5XWxqxftxrG8yQS6065W19d1p4i9j6bimhWZUHBY2ns6sjyCCBAoGBAP7Q9W1dBURGsBi7K3WvGmYX/tcy/ddG+uNm/driWFHIb3McQ24m/Y39q2X6XJ8YzQUenblNmccRZe5dWtl4p9GaasW+MPcIn3+MTPvC0gEc1+mNE7CrBlxIi+wY7GLg+pQCLgYRZYO/8+bNlHt4Y8lolc8UV8r3K+rmArMEw0WRAoGBAPsV46aTwvQ1ZO6x5Or98CdyinaOHQay4NxGlAUcdqO+YIabVzSitUFabHPYeCv5mCvqrvIRqmMLWBr/VCjLz9jFEfZcm13r1/hqKnj70zsjJCbgXLcjOlRh4SoEpZUsLMaTcD41HzoS1f7B9oyg1lIGCEiM8rM//1sNK9fFTnHjAoGBAIUjJLipe5D65hNl6AUrIj3pl6tU5zBN09RxAX4V+VNxyFl6kPjCwoQn4B/+OdqemLBuGLazBv/t5TYv7MHnurdXWSZMg0Tvana4FZkNZ7BRI7bRkVIjacVZ2lHXi9r19bbTlLxy5nl6F7OmAkio1GptjKiP1ncjwfyPhSWH/YchAoGBANKAZ3sgJjHXEeeL/P+GJfDsdmkue+dB0ILcKPygAFcHJKW1VkcqogtIY+Q7d4RmnM0007beWJrwx8zagxQwyvBRR93jhd4X+9ioKTOE7HKH46c0MobXYe+cn8k6XBfUETXqJhABOUzWvdH3i1wa+5OIuykYAeGFpfAP+tHK+RlBAoGAEtG9uA8jayx3yp8oBiVkQq2ibH4bgTMfAz7RokYoNf13umSKYMIlJWw7tIZZqpUruFNyKRLybnnX4CkmbpNHCmPlWNXkFEJ2T9rlVMXpCUXBS9YlsarYHPTmMOFdpmRnjDcyXCjieyBQtjtJSpRSwEGt/5rlRzEoM9Aok8fCU2g=",
// 			//异步通知地址
// 			'notify_url' => "http://www.weizhuanwangzhuan.com/index.php/home/Perinfo/notify_url",//用户付完款后的调用方法商家
// 			//同步跳转
// 			'return_url' => "http://www.weizhuanwangzhuan.com/index.php/home/Perinfo/return_url",//用户付款成功后跳转的地址
// 			//编码格式
// 			'charset' => "UTF-8",
// 			//签名方式
// 			'sign_type'=>"RSA2",
// 			//支付宝网关
// 			'gatewayUrl' => "https://openapi.alipay.com/gateway.do",
// 			//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
// 			'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAj4yD7bDCjeRCtOKcV3/1XmS/tXwu0OokShWNuejE+BTVDfCIs0wFhZqLeRFbOPnrERjkfzkNbJ8WuDOK9kstVgPIxitlsRUU6KhXq1l8zJ5K0x4HFKYzkl9OpjsvB19H1lUH0/QxeoaIgW9Yu3LizStwvtPC9h+Dc5yr9xkvios6LctWp2E5Ao35aPe3zl4cF6Cu2nkK3Pm4+yuIJnu38PsuR6U8UPBL03OuN1rpewAbIBhISaSnpf2NKr6cj/5jEy8LWxHkopvDpvhP03thrU+IH3jdBOAtmpQ8ntWM8c0Vgk2ALXdr7lXARMHk+uIGnS9Sivy89HGogXu8c9K02QIDAQAB",
// 	 ),
// ];
//沙箱环境
return [
	 'Alipay'=>array(
	        'app_id' => "2016091600528346",
			//商户私钥，您的原始格式RSA私钥
			'merchant_private_key' => "MIIEpQIBAAKCAQEAtQWYqAN6bZd+97Ouec1yY4zNS+gjsXHfdA0JdKhx1JHzTwhHXYYahRXFY39TAs+vMIiNlPUYBWYAjYzV8CkEtINF9sLYpT4TtMfHVcH18NpQTPKCUNj5la3cu6+vOmyh8SjFk0jesNfmZu/TuiRyv5Al5Saj2DOXD3qidGIg+qpLuGMVGefaoXHigb3w4zj9X9C9u1p/7IgqwUjYj8GwxGL1INpuAvhyY371/gC6Y29PfZHuq6d9nmY6SX/cL42grT0G6IEtr+yTHFPflH5OA6CyALHv3uvGV221OC2A0uhbaxI5tUxxnAiF9O3lxba3Lld6VC9BoN+q4S0IO9HRMQIDAQABAoIBAQCF3pegWMInXcvlvxmethKMEEqaghgzV7Uai7Gcdh2ISE8Y+VRdk5j1Jr6M8FIhWBmE2Ndrez3CcEakZ6ynKI50OEh7TmkM+rV0EfIWN5R8A9cysH0y8OLSkHsWybvahw/T2oUSgOc+/MtFAMMhe2box99ecY7linGCXvzY+ODOvfZQIBOS1g1CTkKS4z62rr/tY7r6NfGM0pkvPNG+f9f527szVHV7Xw4ew4UzfGC7F9pWmyJVyL9JKq7YX/lUx3vI5WoKnUuk3DdsTu/71cmbnCiYbcUtKjGTzDqjQ1vNFd9xx4qo+6uIxNGeKhVc1VQcdvbqP38yKeNOEoQB2NbhAoGBAOj79R7Wioq9h0TWlxvQJQpZCapHq1mv5HKo54WZllOqDo5w2JOwwrkEmaE4cS7MAnBbHrpqg5ZdbSjT+QKRpQDHaG1SvN0W8SCFEY+Yx3oeq8gLB4vUBT7ZQ4aCCOLrX+re1GZx6OAqdOcThEPzLqNvGtm8vtEhPNpLtNqsqp/dAoGBAMbniiNV2onaib+7U4f6YcLlSo4PKW4fH2ShDEnTxluVTCUcSoeSyRB7t3OPjynwj+e7OGjuzEICr+awo6DUreVQAQRd6v0ZGryslggMVS0RtR295U8UFYO1/0IZbK31o0UJPcqOPpSZmihjZ9FNnvGFOUAExooz7YmalVsJJ0tlAoGBAOEOekMWxW+uE1v42rFASHeNeNunLauOUGQ+Kp+QtHkPHc6UzXElX4QwIGNvTU4CPhzguHck6wW2K/szgCfuHvD4rzRjpxL+1WAvir4mvBKITDIKDXkSDxsd7q+hLwpciiQsqgpn4Keh+5k37h1hbNztN4e7XqxPqiPI2+QcxRl1AoGAPAE/6DcPTcUzBzeBFKWRdpVrr32ddw5GjzoSlfcggSKCLTPivBGpPKLGDkPB4doj37nYY7eewU9EN6kURAHFUEeZdvLKYH6BVWgPfvARhh4wcH+IPRoG/4wZLJy076oKDlqiXIgbEwNfwU1z1W3ARIZ3ZfvK1Yii4X9UDXmudA0CgYEAuYjyq9TYy8Y8qr46zabwlAuSMjjWhsVZJ934N3nqt9ClmhsY7e0DdHlllrdyUI2foEtdrWFh5YaLHKShPdu56Xk6Dal58uVKPER8xIUJJI4jIaWfH90Nx9vOSqbK0ss6B8/MEJDYEuYYQ+Yuz01ao7Am6CQ1QcHQDzIh9BoZTMQ=",
			//异步通知地址
			'notify_url' => "http://www.wz.com/index.php/home/Perinfo/notify_url",//用户付完款后的调用方法商家
			//同步跳转
			'return_url' => "http://www.wz.com/index.php/home/Perinfo/return_url",//用户付款成功后跳转的地址
			//编码格式
			'charset' => "UTF-8",
			//签名方式
			'sign_type'=>"RSA2",
			//支付宝网关
			'gatewayUrl' => "https://openapi.alipaydev.com/gateway.do",
			//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
			'alipay_public_key' => "MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAtQWYqAN6bZd+97Ouec1yY4zNS+gjsXHfdA0JdKhx1JHzTwhHXYYahRXFY39TAs+vMIiNlPUYBWYAjYzV8CkEtINF9sLYpT4TtMfHVcH18NpQTPKCUNj5la3cu6+vOmyh8SjFk0jesNfmZu/TuiRyv5Al5Saj2DOXD3qidGIg+qpLuGMVGefaoXHigb3w4zj9X9C9u1p/7IgqwUjYj8GwxGL1INpuAvhyY371/gC6Y29PfZHuq6d9nmY6SX/cL42grT0G6IEtr+yTHFPflH5OA6CyALHv3uvGV221OC2A0uhbaxI5tUxxnAiF9O3lxba3Lld6VC9BoN+q4S0IO9HRMQIDAQAB",
	 ),
];
?>