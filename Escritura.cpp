#include <iostream>
#include <SerialStream.h>
#include <stdio.h>
#include <stdlib.h>
#include <mysql++.h>
#include <mysql.h>
#include <string>
#include <iomanip>
#include <ssqls.h>
#include <result.h>
#include <query.h>
#include <cstdlib>
#include <fstream>
#include <time.h>

#define HOST "localhost"
#define DB "bdrfid"
#define USERNAME "root"
#define PASSWORD "beagle"

using namespace LibSerial;
using namespace std;

char exor(char* d){
    char r = d[0];
    for(int i=1; i < 11; i++){
        r ^= d[i];
    }
    return r;
}
int main(int argc, char** argv)
{    char* code = argv[1];
   char codeTag[9];
    char data[13];    // Tag string
    codeTag[0] = 0x0;
    strcat(codeTag, "C");
    strcat(codeTag, code);
    strcat(codeTag, "T");
    // Heading
    data[0]=(char)0x02;
    data[1]=(char)0x00;
    data[2]=(char)0x57;
    // String
    printf("First command line argument: %s\n", code);
    strcpy(data + 3, codeTag);
    printf("Sring to write -> %s\n", data + 3);
    // Last bytes
    data[11]=exor(data);
    data[12]=(char)0x03;    // Serial parameters definition
    SerialStream my_serial_port ;
    SerialStream my_serial_stream( "/dev/ttyUSB0" ) ;
    my_serial_stream.SetBaudRate( SerialStreamBuf::BAUD_9600 ) ;
    my_serial_stream.SetCharSize( SerialStreamBuf::CHAR_SIZE_8 ) ;
    my_serial_port.SetNumOfStopBits(1) ;
    my_serial_port.SetParity( SerialStreamBuf::PARITY_ODD ) ;
    my_serial_port.SetFlowControl( SerialStreamBuf::FLOW_CONTROL_HARD ) ;
    // Write data array to serial port
    printf("Writing to serial port...\n");

    for(int i=0; i < 13; i++)
        my_serial_stream << data[i];
    my_serial_port.Close();
    // Write to database
    mysqlpp::Connection connection (DB, HOST, USERNAME, PASSWORD);
    cout << "Conexión con el servidor de MySQL establecida." << endl;
    mysqlpp::Query query = connection.query();
    cout << code << endl;
    query << "INSERT INTO tabla3" << "(codigo, nombre, apellido, email, dependencia, edad) VALUES (\""
        << code << "\", \""
        << argv[2] << "\", \""
        << argv[3] << "\", \""
        << argv[4] << "\", \""
        << argv[5] << "\",\""
        << argv[6] << "\" )";
    query.execute();
    return 0;
}
