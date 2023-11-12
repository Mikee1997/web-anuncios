<!DOCTYPE html
    PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html dir="ltr" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta name="x-apple-disable-message-reformatting">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="telephone=no" name="format-detection">
    <title></title>


    <!--[if !mso]><!-- -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,700,700i" rel="stylesheet">
    <!--<![endif]-->
</head>

<body>
    <div dir="ltr" class="es-wrapper-color">

        <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0">
            <tbody>
                <tr>
                    <td class="esd-email-paddings" valign="top">
                        <table class="esd-header-popover es-header" cellspacing="0" cellpadding="0" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe" align="center">
                                        <table class="es-header-body" width="600" cellspacing="0" cellpadding="0"
                                            bgcolor="#ffffff" align="center">
                                            <tbody>
                                                <tr>
                                                    <td class="es-p20t es-p20r es-p20l esd-structure" align="left">

                                                        <table class="es-left" cellspacing="0" cellpadding="0"
                                                            align="left">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="es-m-p0r es-m-p20b esd-container-frame"
                                                                        width="180" valign="top" align="center">
                                                                        <table width="100%" cellspacing="0"
                                                                            cellpadding="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="center"
                                                                                        class="esd-block-image"
                                                                                        style="font-size:0"><a
                                                                                            target="_blank" href="{{route('index')}}"><img
                                                                                                class="adapt-img esdev-empty-img"
                                                                                                src="{{asset('images/logo.png')}}"
                                                                                                alt width="100%"
                                                                                                height="100"
                                                                                                ></a>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--[if mso]></td><td width="20"></td><td width="360" valign="top"><![endif]-->
                                                        <table cellspacing="0" cellpadding="0" align="right">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="esd-container-frame" width="360"
                                                                        align="left">
                                                                        <table width="100%" cellspacing="0"
                                                                            cellpadding="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="left"
                                                                                        class="esd-block-text">
                                                                                        <p
                                                                                            style="font-family: 'source sans pro', 'helvetica neue', helvetica, arial, sans-serif; font-size: 44px; color: #0000ff;">
                                                                                            <strong>VeciMarket</strong><br
                                                                                                type="_moz"></p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--[if mso]></td></tr></table><![endif]-->
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="es-content" cellspacing="0" cellpadding="0" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe" align="center">
                                        <table class="es-content-body" width="600" cellspacing="0" cellpadding="0"
                                            bgcolor="#ffffff" align="center">
                                            <tbody>
                                                <tr>
                                                    <td class="es-p20t es-p20r es-p20l esd-structure" align="left">
                                                        <table width="100%" cellspacing="0" cellpadding="0">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="esd-container-frame" width="560"
                                                                        valign="top" align="center">
                                                                        <table width="100%" cellspacing="0"
                                                                            cellpadding="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align="left"
                                                                                        class="esd-block-text">
                                                                                        <p>{{__('You can now pick up your reservation')}}: {{$anuncio->title}}</p>
                                                                                        <p><br></p>
                                                                                        <p>{{__('You must pick it up before')}}
                                                                                            {{$anuncio->available_at->addDays(3)->format('d/m/Y')}} {{__('at')}} {{$anuncio->pickPoint->name}}</p>
                                                                                            <p>{{__('At the address')}}: {{$anuncio->pickPoint->direccion}}</p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table class="esd-footer-popover es-footer" cellspacing="0" cellpadding="0" align="center">
                            <tbody>
                                <tr>
                                    <td class="esd-stripe" align="center">
                                        <table class="es-footer-body" width="600" cellspacing="0" cellpadding="0"
                                            bgcolor="#ffffff" align="center">
                                            <tbody>
                                                <tr>
                                                    <td class="esd-structure es-p20t es-p20b es-p20r es-p20l"
                                                        align="left">
                                                        <!--[if mso]><table width="560" cellpadding="0"
                        cellspacing="0"><tr><td width="270" valign="top"><![endif]-->
                                                        <table class="es-left" cellspacing="0" cellpadding="0"
                                                            align="left">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="es-m-p20b esd-container-frame"
                                                                        width="270" align="left">
                                                                        <table width="100%" cellspacing="0"
                                                                            cellpadding="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="esd-empty-container"
                                                                                        style="display: none;"
                                                                                        align="center"></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--[if mso]></td><td width="20"></td><td width="270" valign="top"><![endif]-->
                                                        <table class="es-right" cellspacing="0" cellpadding="0"
                                                            align="right">
                                                            <tbody>
                                                                <tr>
                                                                    <td class="esd-container-frame" width="270"
                                                                        align="left">
                                                                        <table width="100%" cellspacing="0"
                                                                            cellpadding="0">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td class="esd-empty-container"
                                                                                        style="display: none;"
                                                                                        align="center"></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <!--[if mso]></td></tr></table><![endif]-->
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
