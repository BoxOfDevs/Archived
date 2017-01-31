Description
============
Ever needed a multi-feature TeamPVP plugin? Use this! It sorts players into either Red Team or Blue Team when they join the server, making sure there are an even amount of players in each team, players nametags are changed to the colour of their team, and they can't hurt other members of their team, as well as spawning players in armour the colour of their team! When a player dies they also automatically change teams, although sometimes the sorter may leave it in the same team. There is another feature which automatically spawns them with armour the colour of their team, and you can customize all the other items they spawn and respawn with.

Commands
=========
All the commands included in TeamSorter:

    - /changeteam red|blue [player] : Changes yours or another players team

Permissions
============
All the permissions included in TeamSorter:

    - teamsorter : TeamSorter Universal Permission, Default: False

        • teamsorter.change : Allows /changeteam, Default: OP

Configuration
==============
Anything you might need to know about configureing this:

    WARNING: Whatever you do, do not edit data.yml, it will mess up your TeamPVP!

    config.yml -> Items

    # Any items that you want a player to get whenever they join or respawn. Format = "ID:DAMAGE:AMOUNT". Add as many as you want :), Example below!

    Items:
    - "272:0:1"
    - "260:0:32"

    config.yml -> Prefix

    # The prefix that you want to show with all TeamSorter's broadcasts and messages. Use & or § to colour the text.

    Prefix: "§0[§aTeamSorter§0]"

Usage & Installation
=====================
This is a plugin for ImagicalMine: MCPE Server Software (https://imagicalmine.net/), and can be downloaded from http://software.boxofdevs.ml/. Once you have downloaded the TeamSorter_v1.0.phar simply stick it into your plugins folder, and you are done!

Authors
========
The BoxOfDevs Team members who have contributed and developed TeamSorter:

    - TheDragonRing

    - UltimateMcraft