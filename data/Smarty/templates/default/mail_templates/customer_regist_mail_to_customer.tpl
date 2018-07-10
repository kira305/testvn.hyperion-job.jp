
<!--{$arrForm.name01}--><!--{$arrForm.name02}--> 様

求人情報・お仕事紹介サイト「ハイペリオン」でございます。

この度は会員にご登録いただきまして、ありがとうございます。
ご登録が完了しましたので、お知らせいたします。

お好みに合ったお仕事がきっと見つかりますので、ぜひ「ハイペリオン」
をご利用ください。
まずは登録にあたっての説明をさせていただきますので、お申し込みが
まだの方はこちらからどうぞ。（すぐに済みます！）

<!--{$smarty.const.HTTP_URL}-->user_data/explanation.php

今後とも「ハイペリオン」をよろしくお願いいたします。

<!--{$smarty.const.HTTP_URL}-->

■　お祝い金キャンペーン申し込み：<!--{$campaign}-->
■　お名前：<!--{$arrForm.name01}--> <!--{$arrForm.name02}-->　（<!--{$arrForm.kana01}--> <!--{$arrForm.kana02}-->）
■　郵便番号：〒<!--{$arrForm.zip01}--> - <!--{$arrForm.zip02}-->
■　住所：<!--{$pref}--><!--{$arrForm.addr01}--><!--{$arrForm.addr02}-->
■　電話番号：<!--{$arrForm.tel01}--> - <!--{$arrForm.tel02}--> - <!--{$arrForm.tel03}-->
■　メールアドレス：<!--{$arrForm.email}-->
■　生年月日：<!--{if strlen($arrForm.year) > 0 && strlen($arrForm.month) > 0 && strlen($arrForm.day) > 0}--><!--{$arrForm.year|h}-->年<!--{$arrForm.month|h}-->月<!--{$arrForm.day|h}-->日<!--{else}-->未登録<!--{/if}-->
■　希望するパスワード：<!--{$arrForm.password}-->
■　パスワードを忘れた時のヒント
    質問：<!--{$reminder}-->
    答え：<!--{$arrForm.reminder_answer}-->
■　お仕事に関するご希望：<!--{$arrForm.note}-->
■　メールマガジン送付について：<!--{if $arrForm.mailmaga_flg eq 1}-->HTMLメール＋テキストメールを受け取る<!--{elseif $arrForm.mailmaga_flg eq 2}-->テキストメールを受け取る<!--{else}-->受け取らない<!--{/if}-->

----------------------------------------------------------------------
※本メールは自動配信メールです。等幅フォント(MSゴシック12ポイント、
　Osaka-等幅など)で最適にご覧になれます。

※本メールは、求人情報サイト「ハイペリオン」に会員登録して
　いただいた方にお送りしています。
　もしお心当たりが無い場合は、大変お手数ですがその旨を
　以下の連絡先までご一方くださいますようお願いいたします。

　　メール：info@hyperion-job.jp
　　電話：048-451-3877


