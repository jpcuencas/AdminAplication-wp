#!/bin/bash
#
# -*- ENCODING: UTF-8 -*-
# Este programa es software libre. Puede redistribuirlo y/o
# modificarlo bajo los términos de la Licencia Pública General
# de GNU según es publicada por la Free Software Foundation,
# bien de la versión 2 de dicha Licencia o bien (según su
# elección) de cualquier versión posterior.
#
# Si usted hace alguna modificación en esta aplicación,
# deberá siempre mencionar al autor original de la misma.
#
# Copyleft 2012, DesdeLinux.net {Ciudad Habana, Cuba}.
# Autor: KZKG^Gaara <kzkggaara@desdelinux.net> <http://desdelinux.net>
#

# ejecutar en terminal
# echo  -n 'texto a encriptar' | openssl md5


: ${ME:='gaara'}
: ${WHILE:=0}

# if [ "$USER" != "$ME" ]; then
#  	rm *.sh
# 	kdialog --error "Sorry but u are not me. Auto-destroying..." --title "Im Me..."
# 	exit
# fi

kdialog --yesno "¿Eres KZKG^Gaara?"
if [ $? -ne 0 ]; then
		exit
	else
		: ${MWORD:=`kdialog --password "Si eres yo, conocerás la entrada..." --title "Say the magic word"`}
		echo $MWORD > temp.txt
		: ${SUM1:='2dac690b816a43e4fd9df5ee35e3790d'}
		: ${SUM2:=`md5sum temp.txt | awk '{print $1}'`}
		rm temp.txt

		if [ "$SUM1" = "$SUM2" ]; then
			cd /home/shared/hosted/
			rar x me.rar -hp$MWORD >> /dev/null && rm me.rar >> /dev/null
			chmod 777 -R me/ >> /dev/null
			kdialog --msgbox "Hey! ... u have less than 10 seconds to open 'The' browser ;) " --title "Browser"
			sleep 10
			while [ $WHILE=0 ] ; do
				ps aux | grep rekonq | grep -v grep >> /dev/null
					if [ $? -ne 0 ]; then
						rar a me.rar -hp$MWORD me/* >> /dev/null && rm -R me/ >> /dev/null
						MWORD="gggrrr... ¬_¬ "
						exit
					fi
				sleep 3
			done
		else
			MWORD="gggrrr... ¬_¬ "
			kdialog --error "BEEEP!! ... wrong answer..." --title "Ups!"
		fi
fi

exit 0