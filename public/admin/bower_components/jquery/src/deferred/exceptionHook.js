<?xml version="1.0" encoding="UTF-8"?>
<project name="manifest" default="setup">
    <target name="setup" depends="clean,install-tools,install-dependencies"/>

    <target name="clean" unless="clean.done" description="Cleanup build artifacts">
        <delete dir="${basedir}/tools"/>
        <delete dir="${basedir}/vendor"/>
        <delete file="${basedir}/src/autoload.php"/>

        <property name="clean.done" value="true"/>
    </target>

    <target name="prepare" unless="prepare.done" depends="clean" description="Prepare for build">
        <property name="prepare.done" value="true"/>
    </target>

    <target name="install-d