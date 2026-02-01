// #include <stdio.h>
// #include <stdlib.h>
// #include <string.h>
// int main(int c, char **v) {char F[] = { '%','f','\n','\0' };char Z[] = { '0','\0' };double (*op)(double,double) =(double(*)(double,double)) (c > 2 ? (void*)( + (long long)((double(*)(double,double))[](double a,double b){ return a / b; })) : NULL); double a = c > 1 ? strtod(v[1], NULL) : strtod(Z, NULL); double b = c > 2 ? strtod(v[2], NULL) : strtod(Z, NULL); double r = op ? op(a, b) : 0.0; printf(F, r); return !!op;}

#include <stdio.h>
#include <stdlib.h>

int main(int argc, char *argv[]) {
    int nb1 = atoi(argv[1]);
    int nb2 = atoi(argv[2]);

    float result = (float)nb1 / (float)nb2;

    printf("%f\n", result);

    return 0;
}