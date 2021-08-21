ValorantWidget
====
"ValorantWidget"は、ストリーマー向けに開発されたリアルタイムのランクTier / ランクレーティングを表示するウィジェットです。
![image](https://user-images.githubusercontent.com/25396805/130334416-94e153ce-b180-4772-991f-09e3033582aa.PNG)

## English
[\[English ver.\]](README.md)

## 利用上の注意 / 免責事項
本ツールはRiot公式とは一切の関係がありません。
利用については全て利用者の責任の元に行われ、
開発者及び開発コミュニティはこのシステムを利用した事によって生じた一切の障害、損害、その他一切の責任を負うことはないことを明示する。

## ツールの特徴
ツールはダウンロードした利用者のPCのみで動作が可能で、
利用の際に必要なユーザーネームとパスワードは利用者とRiotとの間のみで通信が行われます。
常にオープンソースで開発され、開発者及び開発コミュニティが利用者のセキュリティ保護に尽力しています。

OBSなどの配信ツールに出力するウィジェットはHTML / CSSでテンプレートが用意されており、
利用者自身がカスタマイズを行うことが可能です。
セキュリティ上の問題からテンプレートは常にデフォルト、もしくは[VW-template](https://github.com/nolldayo/VW-template)にて公開されているものを利用してください。
デフォルト及び[VW-template](https://github.com/nolldayo/VW-template)は、開発者及び開発者コミュニティにより常にセキュリティ上のチェックが行われた後に公開されています。

## 導入方法
現在、導入方法の動画を準備しています。
導入方法が分からない方は、[Twitter](https://twitter.com/YNZjp)までご連絡ください。

ツールの利用には、PHPの環境がWindowsにセットアップされている必要があります。
既に導入されている方は、この導入部をスキップしてください。
上記の意味が分からない方は、セットアップされていないはずなので以下の手順を行ってください。

1.PHPをインストールする
PHPをWindowsの環境変数に追加する必要があります。
手動で導入出来る方は、手動で行ってください。
以下の手順は、XAMPPをインストールする最も簡単な方法です。

[XAMPP](https://www.apachefriends.org/jp/index.html)の公式ページより、Windows向けのインストーラーをインストールしてください。
![xampp](https://user-images.githubusercontent.com/25396805/130334532-b034c8c5-daa2-4491-aa5a-b2dd8c4f13ec.PNG)
全て「Next」を押して、ウィザードを終了させてください。
![x1](https://user-images.githubusercontent.com/25396805/130334628-9fb6d6cd-0f4e-4306-8fe1-9b0344addfff.PNG)
「Do you want to start the Control Panel now?」はチェックを外しても問題ありません。
![x2](https://user-images.githubusercontent.com/25396805/130334643-c4626eff-19ad-490f-8314-c53785861bed.jpg)

XAMPPをインストールしたことにより、ツールの利用に必要なPHPの環境設定は自動的に完了しました。

2.Valorant Widgetをダウンロードする
本GithubよりCloneしてください。
Githubの使い方が分からない方は、このページの緑色の「Code」をクリックすると、「Download ZIP」が出てくるのでそこをクリックしてZIPをダウンロードしてください。
![dl](https://user-images.githubusercontent.com/25396805/130334720-2bf1e35b-ad70-4e83-821a-acfd0d65c2f6.PNG)

3.Valorant Widgetをセッティングする
ダウンロードされたZIPを解凍すると、以下のようなフォルダが表示されます。
![v1](https://user-images.githubusercontent.com/25396805/130334759-6bbce760-9d8e-45a0-b4af-c9bb0bb01864.PNG)

まず、ユーザー名やパスワードを設定する必要があります。「setting.txt」を開いて以下のように設定してください。
「username=Riotのユーザー名」 ここは、Valorantのユーザー名とは違うので注意してください。
「password＝Riotのパスワード」
「server=サーバーリストを参照。日本の方はap」
![v2](https://user-images.githubusercontent.com/25396805/130334797-d63702b1-b695-4eff-a50a-8dd3db99a688.PNG)

サーバーリスト
|  North America  |  Europe  |  Asia Pacific  |  Korea  |
| ---- | ---- | ---- | ---- |
|  na  |  eu  |  ap  |  kr  |

Valorant Widgetの設定は完了です！
お疲れさまでした！

3.Valorant Widgetを起動する
フォルダの中にある、
「#ValorantWidget.bat」
を起動してください。正常に設定されていれば以下のような画面が表示されるので、最小化することが可能です。
![main](https://user-images.githubusercontent.com/25396805/130334923-228fbe94-3884-4b97-8613-4ec1f0978db7.PNG)

自作のシステムの為、ランク情報をPC内に保存する際にアンチウイルスソフトが起動する可能性があります。
このツールは本Githubプロジェクト上にてオープンソースで開発されており、利用者自身がソースコードを閲覧しその安全性を確認することが出来ます。
安全であると思われましたら、許可を行ってください。その後にツールを再起動することにより正常な稼働が開始します。
![sec](https://user-images.githubusercontent.com/25396805/130334967-73e75a5b-9a14-45c5-8318-80d3daa47e6c.PNG)

配信中は、*常に「#ValorantWidget.bat」が起動されている必要があります。*
30秒間隔で最新のランクTierとランクレーティングが確認され、アウトプット用データが更新されます。

4.アウトプット用htmlファイルをOBSに設定する
(説明はStreamlabs OBSで行っています)

まずは、ソースの追加よりブラウザソースの追加を選択してください。
![o1](https://user-images.githubusercontent.com/25396805/130335170-a2c344c7-4628-47c9-8cd4-4da47f43eccc.PNG)
![o2](https://user-images.githubusercontent.com/25396805/130335177-33fe55d4-6492-4050-aaf7-ce5cd273ded7.PNG)

ローカルのHTMLファイルを読み込む必要があるので、ローカルファイルにチェックを入れ、「参照」より
ValorantWidgetフォルダの「#template」 > *「output.html」を追加してください*
![o3](https://user-images.githubusercontent.com/25396805/130335180-8afcc20b-1585-456a-b995-02e68f3fe2d4.PNG)
![o4](https://user-images.githubusercontent.com/25396805/130335220-812b8b8f-186e-47c7-b111-28c6c1a2616f.PNG)

幅700、高さ200を設定し、
「シーンがアクティブになったときにブラウザの表示を更新」にチェックを入れて完了を押してください。
![o5](https://user-images.githubusercontent.com/25396805/130335224-75ebda04-2a38-4579-a06f-5108975c008d.PNG)

ウィジェットの追加が完了しました！
表示されたウィジェットは表示に支障のない範囲で拡大・縮小・移動が可能です。お好みの位置に移動させてください。
初期状態では何も表示されていませんが、Step3が正常に行われており、「#ValorantWidget.bat」が常時起動されていれば、ウィジェットは自動で現在のランク情報を表示します。
![o6](https://user-images.githubusercontent.com/25396805/130335265-2f3382f3-8ae2-4345-8f00-24a2838b8cbb.PNG)


導入お疲れさまでした。
次回から、配信時に*常に「#ValorantWidget.bat」を起動することを忘れないでください。*

## ライセンス
個人・商用利用問わず利用者は自由に本ツールを利用することができます。

## 開発者
ご不明な点、ご意見がありましたらTwitterまで

Twitter [@YNZjp](https://twitter.com/YNZjp)
Youtube [YNZ](https://www.youtube.com/channel/UCn9l51qQWN6ZZHF-7AK01Gw)
Twitch [YNZjp](https://www.twitch.tv/ynzjp)

## 御礼
本プロジェクトの制作にあたり、以下のプロジェクトの情報を参考させていただきました。
厚く御礼申し上げます。

[ValorantStreamOverlay by RumbleMike](https://github.com/RumbleMike/ValorantStreamOverlay)
[Valorant App Developers](https://discord.gg/a9yzrw3KAm)
[Valorant Font by brylark](https://www.reddit.com/r/VALORANT/comments/g0747t/valorant_font/)
