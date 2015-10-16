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

using namespace LibSerial ;
using namespace std ;

FILE *fin ;
char cadena[7];
char k=0;
int unsigned i;
int unsigned j;

#define HOST "localhost" // so, where's your mysql server?
#define DB "bdrfid" // and database name?
#define USERNAME "root" // a user granted access to the above database?
#define PASSWORD "beagle" // enter the password for the above user. If there's no password, leave it as it is...

void getDate(char* s1, char* s2){
  char *Day[7] = {
                   "Sunday"  , "Monday", "Tuesday", "Wednesday",
                   "Thursday", "Friday", "Saturday"
                 };

  char *Month[12] = {
                     "January",   "February", "March",    "April",
                     "May",       "June",     "July",     "August",
                     "September", "October",  "November", "December"
                    };

  char *Suffix[] = { "st", "nd", "rd", "th" };
  int i = 3;
  struct tm *OurT = NULL;
  time_t Tval = 0;
  Tval = time(NULL);
  OurT = localtime(&Tval);
  switch( OurT->tm_mday )
  {
    case 1: case 21: case 31:
      i= 0;                  /* Select "st" */
      break;
    case 2: case 22:
      i = 1;                 /* Select "nd" */
      break;
    case 3: case 23:
      i = 2;                 /* Select "rd" */
      break;
    default:
      i = 3;                 /* Select "th" */
      break;
  }

  sprintf(s1, "\nToday is %s the %d%s %s %d", Day[OurT->tm_wday],
      OurT->tm_mday, Suffix[i], Month[OurT->tm_mon], 1900 + OurT->tm_year);
  sprintf(s2, "\nThe time is %d : %d : %d",
                                      OurT->tm_hour, OurT->tm_min, OurT->tm_sec );
}

int main()
{
    char next_char ;
    char fhora[256];
    fhora[0] = 0x0;
    // Turn off led

    printf("turnOffLed.sh -> %d\n", system("/bin/bash -c echo beagle | sudo -S ./turnOffLed.sh 168"));

// definicion de person
    struct Person {
                        int id;
                        string codigo;
                        string nombre;
                        string apellido;
                        string email;
                        string dependencia;
                        string edad;
                    };

Person person;

// serial parameters definition
SerialStream my_serial_port ;
SerialStream my_serial_stream( "/dev/ttyUSB0" ) ;
my_serial_stream.SetBaudRate( SerialStreamBuf::BAUD_9600 ) ;
my_serial_stream.SetCharSize( SerialStreamBuf::CHAR_SIZE_8 ) ;
my_serial_port.SetNumOfStopBits(1) ;
my_serial_port.SetParity( SerialStreamBuf::PARITY_ODD ) ;
my_serial_port.SetFlowControl( SerialStreamBuf::FLOW_CONTROL_HARD ) ;

// mysql conection and search
mysqlpp::Connection connection (DB, HOST, USERNAME, PASSWORD);
cout << "Conexión con el servidor de MySQL establecida." << endl;
mysqlpp::Query query = connection.query();

//my_serial_port
        while (1)
            {
                cout << "TOYLEYENDO!" << endl;
                my_serial_stream >> next_char ;
                cout << "SIGOLEYENDO!" << endl;
                if (k==0)
                {
                    k=1;
                    fin= fopen("read.txt", "wb");
                        if(fin==NULL)
                            {
                                    printf ("Error en la apertura de ficheros de salida \n" );
                                    my_serial_port.Close() ;
                                    return 0;
                            }
                }
                if(next_char=='C')
                    {
                        i=0;
                        printf("Leyendo 6 caracteres ...\n");
                        while (next_char!='T')
                            {
                                fwrite(&next_char, 1, 1, fin);
                                my_serial_stream >> next_char ;
                                if (next_char!='T')
                                    {
                                        cadena[i]=next_char;
                                        printf("%d:%c ", i, cadena[i]);
                                        i++;
                                    }
                            }
                            printf("\nCaracter T encontrado\n");
                            cadena[6] = 0x0;
   fclose(fin);
   k=0;
//base de datos acceso
    printf("Cadena leida: %s\n", cadena);
    query << "SELECT * FROM tabla WHERE codigo = \"" << cadena << "\"";
    cout << "paso7" << endl;



        mysqlpp::StoreQueryResult result = query.store();
        mysqlpp::Row row; // this is for row[""]
        mysqlpp::StoreQueryResult::iterator i;
        int count = 0;
        for ( i = result.begin(); i != result.end() ; i++ ) { // loop till the end of result.
                                    row = *i;
                                    cout << "\nRecord #" << ++count << "\tcodigo: " << row["codigo"] << endl;
                                    cout.setf(ios::left);
                                    cout << setw(10) << "codigo" << row["codigo"] << "\n"
                                    << setw(10) << "nombre" << row["nombre"] << "\n"
                                    << setw(10) << "apellido" << row["apellido"] << "\n"
                                    << setw(10) << "email" << row["email"] << "\n"
                                    << setw(10) << "dependencia" << row["dependencia"] << "\n"
                                    << setw(10) << "ad" << row["edad"] << "\n";
                            }
                            cout << "\nTotally, " << result.size() << " records listed.\n\n";
                            if(result.size() > 0){
                                printf("valor retorna por led.sh -> %d\n", system("/bin/bash -c echo beagle | sudo -S ./led.sh 168"));
                            }
                    }
        // Update table 2 in database tabla
        char hora[256];
        char fecha[256];
        getDate(fecha, hora);
        if(strcmp(hora, fhora)){
        cout << "INSERT INTO tabla3 " << "(hora, codigo, fecha) VALUES (\""
        << hora << "\", \""
        << cadena << "\", \""
        << fecha << "\" )";
        query << "INSERT INTO tabla3 " << "(hora, codigo, fecha) VALUES (\""
        << hora << "\", \""
        << cadena << "\", \""
        << fecha << "\" )";
        query.execute();
        }
        strcpy(fhora, hora);
	}
    cout << "TERMINECANSADO!" << endl;
    my_serial_port.Close() ;
    return 0;
}
