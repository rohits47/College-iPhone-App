//
//  testmain.m
//  CollegeSocial
//
//  Created by Rohit Sanbhadti on 8/5/11.
//  Copyright 2011 Harker High School. All rights reserved.
//

//#import <UIKit/UIKit.h>
#import "LocalStorageController.h"

int main(void)
{
	LocalStorageController *plistController = [LocalStorageController new];
	[plistController writeToDatabase];
	return 0;
}