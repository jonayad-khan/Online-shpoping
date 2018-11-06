<?php

namespace Illuminate\Http\Testing;

class MimeType
{
    /**
     * An array of extension to MIME types.
     *
     * @var array
     */
    protected static $mimes = [
        'ez' => 'application/andrew-inset',
        'aw' => 'application/applixware',
        'atom' => 'application/atom+xml',
        'atomcat' => 'application/atomcat+xml',
        'atomsvc' => 'application/atomsvc+xml',
        'ccxml' => 'application/ccxml+xml',
        'cdmia' => 'application/cdmi-capability',
        'cdmic' => 'application/cdmi-container',
        'cdmid' => 'application/cdmi-domain',
        'cdmio' => 'application/cdmi-object',
        'cdmiq' => 'application/cdmi-queue',
        'cu' => 'application/cu-seeme',
        'davmount' => 'application/davmount+xml',
        'dbk' => 'application/docbook+xml',
        'dssc' => 'application/dssc+der',
        'xdssc' => 'application/dssc+xml',
        'ecma' => 'application/ecmascript',
        'emma' => 'application/emma+xml',
        'epub' => 'application/epub+zip',
        'exi' => 'application/exi',
        'pfr' => 'application/font-tdpfr',
        'gml' => 'application/gml+xml',
        'gpx' => 'application/gpx+xml',
        'gxf' => 'application/gxf',
        'stk' => 'application/hyperstudio',
        'ink' => 'application/inkml+xml',
        'ipfix' => 'application/ipfix',
        'jar' => 'application/java-archive',
        'ser' => 'application/java-serialized-object',
        'class' => 'application/java-vm',
        'js' => 'application/javascript',
        'json' => 'application/json',
        'jsonml' => 'application/jsonml+json',
        'lostxml' => 'application/lost+xml',
        'hqx' => 'application/mac-binhex40',
        'cpt' => 'application/mac-compactpro',
        'mads' => 'application/mads+xml',
        'mrc' => 'application/marc',
        'mrcx' => 'application/marcxml+xml',
        'ma' => 'application/mathematica',
        'mathml' => 'application/mathml+xml',
        'mbox' => 'application/mbox',
        'mscml' => 'application/mediaservercontrol+xml',
        'metalink' => 'application/metalink+xml',
        'meta4' => 'application/metalink4+xml',
        'mets' => 'application/mets+xml',
        'mods' => 'application/mods+xml',
        'm21' => 'application/mp21',
        'mp4s' => 'application/mp4',
        'doc' => 'application/msword',
        'mxf' => 'application/mxf',
        'bin' => 'application/octet-stream',
        'oda' => 'application/oda',
        'opf' => 'application/oebps-package+xml',
        'ogx' => 'application/ogg',
        'omdoc' => 'application/omdoc+xml',
        'onetoc' => 'application/onenote',
        'oxps' => 'application/oxps',
        'xer' => 'application/patch-ops-error+xml',
        'pdf' => 'application/pdf',
        'pgp' => 'application/pgp-encrypted',
        'asc' => 'application/pgp-signature',
        'prf' => 'application/pics-rules',
        'p10' => 'application/pkcs10',
        'p7m' => 'application/pkcs7-mime',
        'p7s' => 'application/pkcs7-signature',
        'p8' => 'application/pkcs8',
        'ac' => 'application/pkix-attr-cert',
        'cer' => 'application/pkix-cert',
        'crl' => 'application/pkix-crl',
        'pkipath' => 'application/pkix-pkipath',
        'pki' => 'application/pkixcmp',
        'pls' => 'application/pls+xml',
        'ai' => 'application/postscript',
        'cww' => 'application/prs.cww',
        'pskcxml' => 'application/pskc+xml',
        'rdf' => 'application/rdf+xml',
        'rif' => 'application/reginfo+xml',
        'rnc' => 'application/relax-ng-compact-syntax',
        'rl' => 'application/resource-lists+xml',
        'rld' => 'application/resource-lists-diff+xml',
        'rs' => 'application/rls-services+xml',
        'gbr' => 'application/rpki-ghostbusters',
        'mft' => 'application/rpki-manifest',
        'roa' => 'application/rpki-roa',
        'rsd' => 'application/rsd+xml',
        'rss' => 'application/rss+xml',
        'sbml' => 'application/sbml+xml',
        'scq' => 'application/scvp-cv-request',
        'scs' => 'application/scvp-cv-response',
        'spq' => 'application/scvp-vp-request',
        'spp' => 'application/scvp-vp-response',
        'sdp' => 'application/sdp',
        'setpay' => 'application/set-payment-initiation',
        'setreg' => 'application/set-registration-initiation',
        'shf' => 'application/shf+xml',
        'smi' => 'application/smil+xml',
        'rq' => 'application/sparql-query',
        'srx' => 'application/sparql-results+xml',
        'gram' => 'application/srgs',
        'grxml' => 'application/srgs+xml',
        'sru' => 'application/sru+xml',
        'ssdl' => 'application/ssdl+xml',
        'ssml' => 'application/ssml+xml',
        'tei' => 'application/tei+xml',
        'tfi' => 'application/thraud+xml',
        'tsd' => 'application/timestamped-data',
        'plb' => 'application/vnd.3gpp.pic-bw-large',
        'psb' => 'application/vnd.3gpp.pic-bw-small',
        'pvb' => 'application/vnd.3gpp.pic-bw-var',
        'tcap' => 'application/vnd.3gpp2.tcap',
        'pwn' => 'application/vnd.3m.post-it-notes',
        'aso' => 'application/vnd.accpac.simply.aso',
        'imp' => 'application/vnd.accpac.simply.imp',
        'acu' => 'application/vnd.acucobol',
        'atc' => 'application/vnd.acucorp',
        'air' => 'application/vnd.adobe.air-application-installer-package+zip',
        'fcdt' => 'application/vnd.adobe.formscentral.fcdt',
        'fxp' => 'application/vnd.adobe.fxp',
        'xdp' => 'application/vnd.adobe.xdp+xml',
        'xfdf' => 'application/vnd.adobe.xfdf',
        'ahead' => 'application/vnd.ahead.space',
        'azf' => 'application/vnd.airzip.filesecure.azf',
        'azs' => 'application/vnd.airzip.filesecure.azs',
        'azw' => 'application/vnd.amazon.ebook',
        'acc' => 'application/vnd.americandynamics.acc',
        'ami' => 'application/vnd.amiga.ami',
        'apk' => 'application/vnd.android.package-archive',
        'cii' => 'application/vnd.anser-web-certificate-issue-initiation',
        'fti' => 'application/vnd.anser-web-funds-transfer-initiation',
        'atx' => 'application/vnd.antix.game-component',
        'mpkg' => 'application/vnd.apple.installer+xml',
        'm3u8' => 'application/vnd.apple.mpegurl',
        'swi' => 'application/vnd.aristanetworks.swi',
        'iota' => 'application/vnd.astraea-software.iota',
        'aep' => 'application/vnd.audiograph',
        'mpm' => 'application/vnd.blueice.multipass',
        'bmi' => 'application/vnd.bmi',
        'rep' => 'application/vnd.businessobjects',
        'cdxml' => 'application/vnd.chemdraw+xml',
        'mmd' => 'application/vnd.chipnuts.karaoke-mmd',
        'cdy' => 'application/vnd.cinderella',
        'cla' => 'application/vnd.claymore',
        'rp9' => 'application/vnd.cloanto.rp9',
        'c4g' => 'application/vnd.clonk.c4group',
        'c11amc' => 'application/vnd.cluetrust.cartomobile-config',
        'c11amz' => 'application/vnd.cluetrust.cartomobile-config-pkg',
        'csp' => 'application/vnd.commonspace',
        'cdbcmsg' => 'application/vnd.contact.cmsg',
        'cmc' => 'application/vnd.cosmocaller',
        'clkx' => 'application/vnd.crick.clicker',
        'clkk' => 'application/vnd.crick.clicker.keyboard',
        'clkp' => 'application/vnd.crick.clicker.palette',
        'clkt' => 'application/vnd.crick.clicker.template',
        'clkw' => 'application/vnd.crick.clicker.wordbank',
        'wbs' => 'application/vnd.criticaltools.wbs+xml',
        'pml' => 'application/vnd.ctc-posml',
        'ppd' => 'application/vnd.cups-ppd',
        'car' => 'application/vnd.curl.car',
        'pcurl' => 'application/vnd.curl.pcurl',
        'dart' => 'application/vnd.dart',
        'rdz' => 'application/vnd.data-vision.rdz',
        'uvf' => 'application/vnd.dece.data',
        'uvt' => 'application/vnd.dece.ttml+xml',
        'uvx' => 'application/vnd.dece.unspecified',
        'uvz' => 'application/vnd.dece.zip',
        'fe_launch' => 'application/vnd.denovo.fcselayout-link',
        'dna' => 'application/vnd.dna',
        'mlp' => 'application/vnd.dolby.mlp',
        'dpg' => 'application/vnd.dpgraph',
        'dfac' => 'application/vnd.dreamfactory',
        'kpxx' => 'application/vnd.ds-keypoint',
        'ait' => 'application/vnd.dvb.ait',
        'svc' => 'application/vnd.dvb.service',
        'geo' => 'application/vnd.dynageo',
        'mag' => 'application/vnd.ecowin.chart',
        'nml' => 'application/vnd.enliven',
        'esf' => 'application/vnd.epson.esf',
        'msf' => 'application/vnd.epson.msf',
        'qam' => 'application/vnd.epson.quickanime',
        'slt' => 'application/vnd.epson.salt',
        'ssf' => 'application/vnd.epson.ssf',
        'es3' => 'application/vnd.eszigno3+xml',
        'ez2' => 'application/vnd.ezpix-album',
        'ez3' => 'application/vnd.ezpix-package',
        'fdf' => 'application/vnd.fdf',
        'mseed' => 'application/vnd.fdsn.mseed',
        'seed' => 'application/vnd.fdsn.seed',
        'gph' => 'application/vnd.flographit',
        'ftc' => 'application/vnd.fluxtime.clip',
        'fm' => 'application/vnd.framemaker',
        'fnc' => 'application/vnd.frogans.fnc',
        'ltf' => 'application/vnd.frogans.ltf',
        'fsc' => 'application/vnd.fsc.weblaunch',
        'oas' => 'application/vnd.fujitsu.oasys',
        'oa2' => 'application/vnd.fujitsu.oasys2',
        'oa3' => 'application/vnd.fujitsu.oasys3',
        'fg5' => 'application/vnd.fujitsu.oasysgp',
        'bh2' => 'application/vnd.fujitsu.oasysprs',
        'ddd' => 'application/vnd.fujixerox.ddd',
        'xdw' => 'application/vnd.fujixerox.docuworks',
        'xbd' => 'application/vnd.fujixerox.docuworks.binder',
        'fzs' => 'application/vnd.fuzzysheet',
        'txd' => 'application/vnd.genomatix.tuxedo',
        'ggb' => 'application/vnd.geogebra.file',
        'ggt' => 'application/vnd.geogebra.tool',
        'gex' => 'application/vnd.geometry-explorer',
        'gxt' => 'application/vnd.geonext',
        'g2w' => 'application/vnd.geoplan',
        'g3w' => 'application/vnd.geospace',
        'gmx' => 'application/vnd.gmx',
        'kml' => 'application/vnd.google-earth.kml+xml',
        'kmz' => 'application/vnd.google-earth.kmz',
        'gqf' => 'application/vnd.grafeq',
        'gac' => 'application/vnd.groove-account',
        'ghf' => 'application/vnd.groove-help',
        'gim' => 'application/vnd.groove-identity-message',
        'grv' => 'application/vnd.groove-injector',
        'gtm' => 'application/vnd.groove-tool-message',
        'tpl' => 'application/vnd.groove-tool-template',
        'vcg' => 'application/vnd.groove-vcard',
        'hal' => 'application/vnd.hal+xml',
        'zmm' => 'application/vnd.handheld-entertainment+xml',
        'hbci' => 'application/vnd.hbci',
        'les' => 'application/vnd.hhe.lesson-player',
        'hpgl' => 'application/vnd.hp-hpgl',
        'hpid' => 'application/vnd.hp-hpid',
        'hps' => 'application/vnd.hp-hps',
        'jlt' => 'application/vnd.hp-jlyt',
        'pcl' => 'application/vnd.hp-pcl',
        'pclxl' => 'application/vnd.hp-pclxl',
        'sfd-hdstx' => 'application/vnd.hydrostatix.sof-data',
        'mpy' => 'application/vnd.ibm.minipay',
        'afp' => 'application/vnd.ibm.modcap',
        'irm' => 'application/vnd.ibm.rights-management',
        'sc' => 'application/vnd.ibm.secure-container',
        'icc' => 'application/vnd.iccprofile',
        'igl' => 'application/vnd.igloader',
        'ivp' => 'application/vnd.immervision-ivp',
        'ivu' => 'application/vnd.immervision-ivu',
        'igm' => 'application/vnd.insors.igm',
        'xpw' => 'application/vnd.intercon.formnet',
        'i2g' => 'application/vnd.intergeo',
        'qbo' => 'application/vnd.intu.qbo',
        'qfx' => 'application/vnd.intu.qfx',
        'rcprofile' => 'application/vnd.ipunplugged.rcprofile',
        'irp' => 'application/vnd.irepository.package+xml',
        'xpr' => 'application/vnd.is-xpr',
        'fcs' => 'application/vnd.isac.fcs',
        'jam' => 'application/vnd.jam',
        'rms' => 'ap